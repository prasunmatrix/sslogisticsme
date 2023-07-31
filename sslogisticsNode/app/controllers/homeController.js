/*****************************************************
# Company Name          : Matrix Media Solutions Pvt. Ltd.
# Author                : Dilip Shaw                                   
# Created Date          : 27-09-2018
# Module                : homeController                     
# Object name           : homeController    
# Functionality         : homePage                               
# Purpose               : Only for render a home page. 
*****************************************************/
'use strict';
// ============================================================================

var homeController = {

	//=======================================================================
	/*
        # Function for only for render a home sample page                        
        # Function name 		: homePage                        
        # Author 				: Dilip Shaw                             
        # Created Date 			: 27-07-2018                           
        # Modified date 		:                           
        # Purpose				: only for render a home sample page                             
        # Params :  
    */ 
	homePage : function(req, res, next) {		
		res.render('home');
	},
	//=======================================================================

}

module.exports = homeController;
// ============================================================================
