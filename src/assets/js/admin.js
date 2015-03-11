/* ----------------------------------------------------------------------------
 * Easy!Appointments - WordPress Plugin 
 *
 * @license GPLv3
 * @copyright A.Tselegidis (C) 2015
 * @link http://easyappointments.org
 * @since v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Admin Class 
 * 
 * This class handles the functionality of the plugin's settings page.
 * 
 * @class 
 */
var Admin = function() {
    /**
     * Class Instance
     * 
     * @type Admin
     */
    var $this = this; 
}; 

Admin.prototype.events = function() {
    jQuery('#install').click(function(event) {
        Admin.prototype.install(); 
    });
    
    jQuery('#bridge').click(function(event) {
        Admin.prototype.bridge(); 
    });    
};

Admin.prototype.install = function() {
    jQuery.post('wp-ajax.php', data, function(response) {
        // @todo Handle ajax response. 
    }, 'json'); 
};

Admin.prototype.bridge = function() {
    jQuery.post('wp-ajax.php', data, function(response) {
        // @todo Handle ajax response.
    }, 'json'); 
};