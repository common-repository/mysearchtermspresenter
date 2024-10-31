<?php
/* 
Plugin Name:  MySearchTermsPresenter (MySTP)
Plugin URI:   http://plugins.powerfusion.net/blog/mysearchtermspresenter/
Description:  Collect and present search terms that user have used to find your blog posts. 
Version:      1.02
Author:       Daniel B.
Author URI:   http://netreview.de
*/

/*
  Copyright 2010 NetReview (Daniel B.)  (email : kontakt@netreview.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

global $wpdb;
define (MYSTP_TABLE, $wpdb->prefix.'mysearchterms');

if ( !class_exists('MySearchTermsPresenter') ) {
  class MySearchTermsPresenter {  
    var $referer = '';
    
    function __construct() {
      register_activation_hook(__FILE__, array($this, 'Install'));
      add_action('loop_start', array(&$this, 'addSerchTerms'));
    }    
    
    function Install() {
      global $wpdb;
      
      if ($wpdb->get_var("show tables like '".MYSTP_TABLE."'") != MYSTP_TABLE) {
        $sql = "CREATE TABLE `".MYSTP_TABLE."` (
          `ID`        bigint(20) unsigned NOT NULL auto_increment,
          `post_id`   bigint(20) unsigned NOT NULL,
          `sdate`     datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          `sengine`   text collate utf8_unicode_ci NOT NULL,
          `sterm`     text collate utf8_unicode_ci NOT NULL,
          PRIMARY KEY  (`ID`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
      }
    }
    
    function addSerchTerms() {
      global $wpdb;
      
      $mystp_query_terms = '';
      
      if ( !is_home() ) {
        if ( $this->isRefererSearchEngine('google') ) {
          $mystp_query_terms = $this->getQueryTerms('google');
          if ( !empty($mystp_query_terms) ) {
            $this->addToDatabase($mystp_query_terms);
          }
        }
      }
    }
    
    function isRefererSearchEngine($search_engine) {      
      if( !empty($_SERVER['HTTP_REFERER']) ) { 
        $this->referer = urldecode($_SERVER['HTTP_REFERER']);
      } else { return false; }

      if (preg_match('|^http://(www)?\.?google.*|i', $this->referer)) { return true; } else { return false; }
    }
    
    function getQueryTerms($search_engine) {      
      $query_array = array();
      $query_array[0] = 'Google';
      preg_match('/&q=([^&]+)&?.*$/i', $this->referer, $match);
      $query_array[1] = $match[1];     
      
      return $query_array;
    }   
    
    function addToDatabase($mystp_query_terms) {
      global $wpdb, $post;

      $termID = $wpdb->get_var("SELECT ID FROM ".MYSTP_TABLE." WHERE 
        post_id = '".$post->ID."' AND
        sengine = '".$mystp_query_terms[0]."' AND
        sterm   = '".$mystp_query_terms[1]."'
        ");
      
      if ( empty($termID) ) {
        if ( !empty($mystp_query_terms[0]) && !empty($mystp_query_terms[1])) {
          $sdate = gmdate( 'Y-m-d H:i:s', ( time() + (get_option( 'gmt_offset' ) * 3600 ) ) );
          $query = "INSERT INTO ".MYSTP_TABLE." (
            `post_id`,
            `sdate`,
            `sengine`,
            `sterm`
            ) VALUES (
            '$post->ID',
            '$sdate',
            '$mystp_query_terms[0]',
            '$mystp_query_terms[1]'
            )";
           
          $wpdb->query($query);
        }
      }
    }
  }
}


if ( class_exists('MySearchTermsPresenter') ) {
  $MySTPresenter = new MySearchTermsPresenter();
}

function mystp_get_terms($limit = 10) {
  global $wpdb, $post;

  if ( intval($limit) != 0 ) { $limit = 'LIMIT '.$limit; } else { $limit = ''; }  
  $results = $wpdb->get_results("SELECT * FROM ".MYSTP_TABLE." WHERE post_id = $post->ID ORDER BY RAND() $limit");
  
  if ( !empty($results) ) {    
    $output =  '';    
    foreach ($results as $result) { $output .= '<li>'.$result->sterm.'</li>'."\n"; }    
    echo stripslashes($output);
  }
  else {
    echo '<li>No search results for this post yet...</li>';
  }
}

?>