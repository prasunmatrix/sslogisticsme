/*****************************************************
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 27-09-2018
# Module                : truckModelCallback                     
# Object name           : truckModelCallback    
# Functionality         : getTruckDetailsByTruckNo                                  
# Purpose               : This is a modelcall for ss_trucks tables. truckModelCallback intract with database for read, write, update and delete the records.
*****************************************************/
'use strict';
// ======================================================================
var truckModel = require('./truckModel');

var truckModelCallback = {
    //=======================================================================
    /*
        # Function for get the truck details with truck no.                       
        # Function name        : getTruckDetailsByTruckNo                        
        # Author               : Dilip Shaw                             
        # Created Date         : 27-07-2018                           
        # Modified date        : 28-07-2018                           
        # Purpose              : Received and Save GPS data in json file                          
        # Params               : truck_no
    */ 
    getTruckDetailsByTruckNo : function(truckNo, callback)
    {
        truckModel.query('orderBy', 'id', 'asc').where({
            truck_no : truckNo
        }).fetch({withRelated : [{
            ss_trips : function(query){
                query.where('GPS_trip_status', '=', 'Start');
                query.orderBy('id', 'DESC');
            }
        }]})
        .then(function(truckData){            
            	
	    	// ===========================================================
	    	var response = {};	    	
	        if(truckData != null){	 
                var totalRecords = truckData.length;           	
                response = {
                    trucks: truckData.toJSON(),
                    totalDBRecords : totalRecords,
                    status: 'success',
                    code: '200'
                };
            }else{
                response = {
                    trucks: {},
                    totalDBRecords : 0,
                    status: 'error',
                    message: 'Truck not available',
                    code: '404'
                };
                
            }
            callback(response);	
            // ===========================================================
        })
        .catch(function(error){
            console.log(error);
        });
    },
    //=======================================================================
    
}
module.exports = truckModelCallback;
// ======================================================================
