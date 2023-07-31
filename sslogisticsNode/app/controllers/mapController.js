/*****************************************************
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 28-09-2018
# Module                : mapController                     
# Object name           : mapController    
# Functionality         : gpsTrackingwWithTruck
# Purpose               : Read this json file show the live tracking the truck in google map. 
*****************************************************/
'use strict';
var base64 = require('base-64');
var truckModelCallback = require('../models/truckModelCallback');
const fs = require('fs');
const jsonFileBasepath =  __dirname + '/../../public/json/';
var Promise = require("bluebird");
var bodyParser = require("body-parser");
var formidable = require('formidable');
app.use(bodyParser());
//==========================================================================

//==========================================================================
var mapController = {
    //=======================================================================
    /*
        # Function for read the json file and show the live tracking the truck in google map.                        
        # Function name         : gpsTrackingwWithTruck                        
        # Author                : Dilip Shaw                             
        # Created Date          : 27-07-2018                           
        # Modified date         : 28-07-2018                           
        # Purpose               : Received the base64 formate of the truck no and live tracking the truck in google map. 
        # Params                : slug : base64(truck_no)    
    */ 
    gpsTrackingwWithTruck : function (req, res, next) {
        var truckNo = base64.decode(req.params.slug);        
        var truckArray = [];     
        var postUrl = '/map/device/' + req.params.slug;  
        var fileDatas = {};   
        var mapStatus = false;    
         
        //==============================================================
        res.header('Access-Control-Allow-Origin', '*'); 
        let fileNamePost = '';       
        if(req.body.filename != '')
        {
            fileNamePost = req.body.filename;
        }
        //==============================================================  
        if(truckNo != '')
        {
            //==============================================================
            truckModelCallback.getTruckDetailsByTruckNo(truckNo, function(results){
                //console.log(results);                                    
                //========================================================
                var files = fs.readdirSync(jsonFileBasepath);  
                if(files.length > 0)
                {                  
                    Promise.each(files, function(fileName) {
                        var resArray = fileName.split("_"); 
                        if(resArray.length)
                        {
                            var resArray_io = resArray[0].indexOf('.json');                                
                            if(resArray_io > 1)
                            {
                                var resArray_o = resArray[0].split(".json");                                    
                                if(truckNo == resArray_o[0])
                                {
                                    truckArray.push(fileName);
                                } 
                            }else{
                                if(truckNo == resArray[0])
                                {
                                    truckArray.push(fileName);
                                }
                            }                                
                        }
                    }).then(function() {   
                        if(fileNamePost)
                        {
                            let rawdata = {};
                            let filetargetPath = 'public/json/' + fileNamePost;                            
                            if (fs.existsSync(filetargetPath)) {                                
                                mapController.readFile(filetargetPath, function(data){
                                    
                                    fileDatas = JSON.parse('[' + data + ']'); 
                                    let countF = (fileDatas.length - 1);    
                                    let callFunction = 1;                               
                                    ioServer.sockets.on('connection', function(socket) {
                                        //Whenever someone connects 
                                        console.log('A user connected');                                       
                                        //=================================================
                                        //Whenever someone disconnects 
                                        socket.on('disconnect', function () {
                                            console.log('A user disconnected');
                                        });
                                        //=================================================  
                                        if(callFunction == 1)
                                        {
                                            socket.emit('gpsTracker', fileDatas);  
                                            callFunction = 2; 
                                        }                                      
                                        setInterval(function() {
                                            mapController.readFile(filetargetPath, function(data){
                                                fileDatas = JSON.parse('[' + data + ']');
                                                let countD = (fileDatas.length - 1);
                                                socket.emit('latLng', fileDatas[countD]);                                                
                                            });                                                                                     
                                        }, 30000);
                                        //=================================================
                                    });
                                    
                                    res.render('map_with_truck_no', {
                                        truckArray : truckArray, 
                                        postUrl : postUrl, 
                                        fileDatas : fileDatas
                                    });
                                });                                    
                            }                                
                        }else{                         
                            res.render('map_with_truck_no', {
                                truckArray : truckArray, 
                                postUrl : postUrl, 
                                fileDatas : fileDatas
                            });                      
                        }
                    });                        
                }                    
                //========================================================
            });            
            //==============================================================
        }else{
            res.render('map_with_truck_no', {
                truckArray : truckArray, 
                postUrl : postUrl, 
                fileDatas : fileDatas
            }); 
        }
        //==============================================================

    },
    //=======================================================================
    readFile : function(targetPath, callback){

        fs.readFile(targetPath, 'utf8', function(err, data){
            callback(data);
        });
    }
    //=======================================================================

};
module.exports = mapController;
//==========================================================================