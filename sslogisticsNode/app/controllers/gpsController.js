/*****************************************************
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 27-09-2018
# Module                : gpsController                     
# Object name           : gpsController    
# Functionality         : gpsTrackingDataSave, gpsTrackingDataSaveInFiles                               
# Purpose               : GPS Device Data Save In Json Files 
*****************************************************/
'use strict';
// ============================================================================
var bodyParser = require("body-parser");
var formidable = require('formidable');
var fs = require('fs');
var truckModelCallback = require('../models/truckModelCallback');
app.use(bodyParser()); 

//==base path for json files
var jsonFileBasepath =  __dirname + '/../../public/json/';

var gpsController = {
	//=======================================================================
    /*
        # Function for received GPS Device Json data and save in json file.                       
        # Function name        : gpsTrackingDataSave                        
        # Author               : Dilip Shaw                             
        # Created Date         : 27-07-2018                           
        # Modified date        : 28-07-2018                           
        # Purpose              : Received and Save GPS data in json file                          
        # Params               : unitid, lat, lng, speed, heading, datetime, ignition, location, vehicle
    */ 
	gpsTrackingDataSave : function(req, res, next){

        let resData = {};
        res.header('Access-Control-Allow-Origin', '*');
        var fileStringData = '';
        //==================================================        
        var form = new formidable.IncomingForm();
        form.parse(req, function(err, fields, files) {
            //=============================================================   
            var postFormData = {
                unitid : fields.unitid ? fields.unitid : '',
                lat : fields.lat ? fields.lat : '',
                lng : fields.lng ? fields.lng : '',
                speed : fields.speed ? fields.speed : '',
                heading : fields.heading ? fields.heading : '',
                datetime : fields.datetime ? fields.datetime : '',
                ignition : fields.ignition ? fields.ignition : '',
                location : fields.location ? fields.location : '',
                vehicle : fields.vehicle ? fields.vehicle : ''
            };            
            
            if (fields.unitid != undefined && fields.vehicle != undefined) {
                truckModelCallback.getTruckDetailsByTruckNo(fields.vehicle, function(results){
                    if(results.totalDBRecords != 0)
                    {
                        //=================================================                        
                        if(results.trucks.ss_trips.length == 0)
                        {
                            //=============================================
                            var moment = require("moment"); 
                            var now = moment(new Date());
                            var date = now.format("DD");
                            var year = now.format("YYYY");
                            var month = now.format("MM");   
                            var filenameCreate = results.trucks.truck_no + '_SSLV000' + results.trucks.id + '_' + date + '_' + month + '_' + year + '.json';
                            var jsonFileTargetpath = jsonFileBasepath + filenameCreate;
                            if (!fs.existsSync(jsonFileTargetpath)) {
                                var createStream = fs.createWriteStream(jsonFileTargetpath);
                                fileStringData = JSON.stringify(postFormData); 
                            }else{
                                fileStringData = ',' + JSON.stringify(postFormData);
                            }                                    
                            gpsController.gpsTrackingDataSaveInFiles(jsonFileTargetpath, fileStringData);
                            //=============================================
                        }else{
                            //=============================================
                            var filenameCreate = 'SSLT000' + results.trucks.ss_trips[0].id + '.json';
                            var jsonFileTargetpath = jsonFileBasepath + 'in_trip/' + filenameCreate;
                            if (!fs.existsSync(jsonFileTargetpath)) {
                                var createStream = fs.createWriteStream(jsonFileTargetpath);
                                fileStringData = JSON.stringify(postFormData); 
                            }else{
                                fileStringData = ',' + JSON.stringify(postFormData);
                            }  
                            gpsController.gpsTrackingDataSaveInFiles(jsonFileTargetpath, fileStringData);
                            //=============================================
                        }
                        res.json(postFormData);
                        //=================================================
                    }else{
                       //=============================================
                       var filenameCreate = fields.vehicle + '.json';
                       var jsonFileTargetpath = jsonFileBasepath + filenameCreate;
                       if (!fs.existsSync(jsonFileTargetpath)) {
                           var createStream = fs.createWriteStream(jsonFileTargetpath);
                           fileStringData = JSON.stringify(postFormData); 
                        }else{
                           fileStringData = ',' + JSON.stringify(postFormData);
                        } 
                       gpsController.gpsTrackingDataSaveInFiles(jsonFileTargetpath, fileStringData);
                       res.json(postFormData);
                       //=============================================
                    }
                });            
            }else{
                res.json(resData);
            }
            //=============================================================
        }); 
        //==================================================
        form.on('error', function(err) {
            res.json(resData);    
        });
        //==================================================
    },
    //======================================================================= 
    /*
        # Function for write string in files .                       
        # Function name         : gpsTrackingDataSaveInFiles                        
        # Author                : Dilip Shaw                             
        # Created Date          : 27-07-2018                           
        # Modified date         : 28-07-2018                           
        # Purpose               : This function recevied a filename and some srting and write this string in files.
        # Params                : filename : string, filedata : string    
    */    
    gpsTrackingDataSaveInFiles : function(filename, filedata){
        var filePath = filename;
        if(filedata && filename)
        {
            var data = filedata;
            fs.open(filePath, 'a', 666, function( e, id ) {
                fs.write( id, data, null, 'utf8', function(){
                    fs.close(id, function(){
                        console.log('file is updated');
                        return true;
                    });
                });
            });  
        }
    }
    //=======================================================================
}

module.exports = gpsController;
// ============================================================================
