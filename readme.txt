=== MySearchTermsPresenter ===
Contributors: NetReview
Donate link: http://plugins.powerfusion.net/blog/mysearchtermspresenter/
Tags: Search Terms, Searchers, SEO, Google, Search Phrases, phrases, terms, Adsense, Traffic, Boost
Requires at least: 2.0.2
Tested up to: 2.9.2
Stable tag: 1.01

Boost your traffic and improve your adsense income and the search engine ranking without doing anything with MySearchTermPresenter.

== Description ==
Boost your traffic and improve your adsense income and the search engine ranking without doing anything with MySearchTermPresenter.

This plugin will collect and present search terms and phrases that people have used to find your blog post.  

MySearchTermPresenter will show a random list of used searchers to find a specific post on the bottom of the post.

Supported Search Engine: Google

Do you need more Features and more supported search engines?
Check our PRO version for only $1.99 @ [Powerfusion Premium Plugins](http://plugins.powerfusion.net/blog/mysearchtermspresenter/ "Powerfusion Premium Plugins")

== CHANGELOG ==
v1.01 - 2010-04-11
  Added: Info if there are no search results for the current post
    
v1.00 - 2010-04-08
  Initial Version  

== Installation ==
- Upload the plugin to the `/wp-content/plugins/` directory
- Activate the plugin through the 'Plugins' menu in WordPress

= USAGE INSTRUCTIONS =
Include the function call "mystp_get_terms(10);" in your single.php after the wordpress loop. So 10 random searchterms will be shown in form of a list.

The plugin is really easy to include in your theme. Here is a small code example:

&lt;div class="sterms"&gt;<br />
&lt;h4&gt;Benutzer, die diese Seite fanden, suchten auch nach:&lt;/h4&gt;<br />
&lt;ul&gt;<br />
&lt;?php mystp_get_terms(10); ?&gt;<br />
&lt;/ul&gt;<br />
&lt;/div&gt;<br />

The css class "sterms" can be customized to your desired requirements.

Here are two examples:
= 1. Example:  Vertical list with square bullets =
div.sterms { border: 1px dashed #000; color: #000; padding: 10px; }<br />
div.sterms h4 { color: #000; font-size: 1.4em; font-weight: bold; }<br />
div.sterms ul { color: #8F8F8F; list-style-type: square; padding-left: 20px; }<br />
div.stearms ul li { padding: 5px; }<br />

= 1. Example:  Horizontal list =
div.sterms { border: 1px dashed #000; color: #000; padding: 10px; }<br />
div.sterms h4 { color: #000; font-size: 1.4em; font-weight: bold; }<br />
div.sterms ul { color: #8F8F8F; list-style-type: none; padding: 0; }<br />
div.sterms ul li { display: inline; padding-right: 5px; }<br />

Check <a href="http://netreview.de/wordpress/mysearchtermspresenter/" title="NetReview">NetReview</a> for styling screen shoots.
    
== Frequently Asked Questions ==
[FAQ](http://netreview.de/wordpress/mysearchtermspresenter/ "FAQ")

== Screenshots ==
[Screenshots](http://netreview.de/wordpress/mysearchtermspresenter/ "MySearchTermsPresenter Screenshots")

== Upgrade Notice ==
...