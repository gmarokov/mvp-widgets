<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/gmarokov
 * @since      1.0.0
 *
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/public
 * @author     Georgi <georgi.marokov@gmail.com>
 */
class Mvp_Widgets_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function shortcode_github_activity($atts)
	{
		$atts = shortcode_atts(
			array(
				'username' => 'gmarokov',
				'repository' => '',
		  		'limit' => '20',
			), 
			$atts, 
			'mvp-github-activity' 
		);?>
	  		<style>.gha-footer,.gha-header{width: calc(100% - 1px);}.gha-footer{border-top: none;height: auto;}</style>
	  		<div id="mvp-github-activity-feed"></div>
			<script>
				var name = "<?php echo $atts['username'];?>";
				var rep = "<?php echo $atts['repository'];?>";
				var max = <?php echo $atts['limit'];?>;
				GitHubActivity.feed({
					username: name,
					repository: rep, // optional
					selector: "#mvp-github-activity-feed",
					limit: max // optional
				});
			</script>
		<?php
		
	}
	

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mvp_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mvp_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mvp-widgets-public.css', array(), $this->version, 'all' );


		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mvp_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mvp_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'mvp-github-activity-octicons', plugin_dir_url( __FILE__ ) . 'css/octicons.min.css', array(), '2.0.2');
		wp_enqueue_style( 'mvp-github-activity-css', plugin_dir_url( __FILE__ ) . 'css/github-activity.min.css', array(), '1.4');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mvp_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mvp_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mvp-widgets-public.js', array( 'jquery' ), $this->version, false );

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mvp_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mvp_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'mvp-github-activity-mustache', plugin_dir_url( __FILE__ ) . 'js/mustache.min.js', array(), '0.7.2');
		wp_enqueue_script( 'mvp-github-activity-js', plugin_dir_url( __FILE__ ) . 'js/github-activity.min.js', array(), '1.4');
	}

}
