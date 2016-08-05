<?php

class WP_GeoMeta_Dash {

	/**
	 * Singleton variable
	 *
	 * @var $_instance
	 */
	private static $_instance = null;

	/**
	 * Get the singleton instance.
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	/**
	 * Get the functions by type
	 */
	public function get_functions_by_type() {

		$cap_cats = array(
			'geom_relationship' => array(
				'label' => 'Spatial Relationship Tests',
				'desc' => 'Test topological relationships between two geometries. Some functions may work on a shape\'s bounding box rather than the shape itself.',
				'funcs' => array(
					'Contains',
					'Crosses',
					'Disjoint',
					'Distance',
					'Equals',
					'Intersects',
					'MBRContains',
					'MBRCoveredBy',
					'MBRDisjoint',
					'MBREqual',
					'MBREquals',
					'MBRIntersects',
					'MBROverlaps',
					'MBRTouches',
					'MBRWithin',
					'Overlaps',
					'ST_Contains',
					'ST_Crosses',
					'ST_Dimension',
					'ST_Disjoint',
					'ST_Distance',
					'ST_Equals',
					'ST_Intersects',
					'ST_Overlaps',
					'ST_Touches',
					'ST_Within',
					'Touches',
					'Within',
				)
			),

			'properties' => array(
				'label' => 'Geometry Properties',
				'desc' => 'These functions analyize spatial properties of a single geometry.',
				'funcs' => array(
					'Area',
					'GLength',
					'IsClosed',
					'IsEmpty',
					'IsRing',
					'IsSimple',
					'SRID',
					'ST_Area',
					'ST_GeometryType',
					'ST_IsClosed',
					'ST_IsEmpty',
					'ST_IsRing',
					'ST_IsSimple',
					'ST_IsValid',
					'ST_Length',
					'ST_SRID',
					'ST_Validate',
				)
			),

			'investigation' => array(
				'label' => 'Geometry Disection',
				'desc' => 'Investigate the type and sub-parts of a geometry.',
				'funcs' => array(
					'Dimension',
					'EndPoint',
					'ExteriorRing',
					'GeometryN',
					'GeometryType',
					'InteriorRingN',
					'NumGeometries',
					'NumInteriorRings',
					'NumPoints',
					'PointN',
					'ST_EndPoint',
					'ST_ExteriorRing',
					'ST_GeometryN',
					'ST_InteriorRingN',
					'ST_NumGeometries',
					'ST_NumInteriorRings',
					'ST_NumPoints',
					'ST_PointN',
					'ST_StartPoint',
					'ST_X',
					'ST_Y',
					'StartPoint',
					'X',
					'Y',
				)
			),

			'make_new_geom' => array(
				'label' => 'Generate new Geometry',
				'desc' => 'Create a new geometry based on existing geometries and spatial operations.',
				'funcs' => array(
					'Boundary',
					'Buffer',
					'Centroid',
					'ConvexHull',
					'Envelope',
					'ST_Boundary',
					'ST_Buffer',
					'ST_Centroid',
					'ST_ConvexHull',
					'ST_Difference',
					'ST_Envelope',
					'ST_Intersection',
					'ST_Simplify',
					'ST_SymDifference',
					'ST_Union',
				)
			),

			'change_format' => array(
				'label' => 'Data Format Helpers',
				'desc' => 'Create or convert geometries from various input and output formats.',
				'funcs' => array(
					'GeomCollFromText',
					'GeomCollFromWKB',
					'GeometryCollection',
					'GeometryCollectionFromText',
					'GeometryCollectionFromWKB',
					'GeometryFromText',
					'GeometryFromWKB',
					'GeomFromText',
					'GeomFromWKB',
					'LineFromText',
					'LineFromWKB',
					'LineString',
					'LineStringFromText',
					'LineStringFromWKB',
					'MLineFromText',
					'MLineFromWKB',
					'MPointFromText',
					'MPointFromWKB',
					'MPolyFromText',
					'MPolyFromWKB',
					'MultiLineString',
					'MultiLineStringFromText',
					'MultiLineStringFromWKB',
					'MultiPoint',
					'MultiPointFromText',
					'MultiPointFromWKB',
					'MultiPolygon',
					'MultiPolygonFromText',
					'MultiPolygonFromWKB',
					'Point',
					'PointFromText',
					'PointFromWKB',
					'PolyFromText',
					'PolyFromWKB',
					'Polygon',
					'PolygonFromText',
					'PolygonFromWKB',
					'ST_GeomCollFromText',
					'ST_GeomCollFromWKB',
					'ST_GeometryCollectionFromText',
					'ST_GeometryCollectionFromWKB',
					'ST_GeometryFromText',
					'ST_GeometryFromWKB',
					'ST_GeomFromGeoJSON',
					'ST_GeomFromText',
					'ST_GeomFromWKB',
					'ST_LineFromText',
					'ST_LineFromWKB',
					'ST_LineStringFromText',
					'ST_LineStringFromWKB',
					'ST_PointFromGeoHash',
					'ST_PointFromText',
					'ST_PointFromWKB',
					'ST_PolyFromText',
					'ST_PolyFromWKB',
					'ST_PolygonFromText',
					'ST_PolygonFromWKB',
					'AsBinary',
					'AsText',
					'AsWKB',
					'AsWKT',
					'ST_AsBinary',
					'ST_AsGeoJSON',
					'ST_AsText',
					'ST_AsWKB',
					'ST_AsWKT',
				)
			),
			'other' => array(
				'label' => 'Miscellaneous Functions',
				'desc' => 'Other little-used functions.',
				'funcs' => array(
					'PointOnSurface',
					'ST_Buffer_Strategy',
					'ST_Distance_Sphere',
					'ST_GeoHash',
					'ST_LatFromGeoHash',
					'ST_LongFromGeoHash',
					'ST_PointOnSurface',
					'ST_Relate',
				),
			),
		);

		$our_caps = WP_GeoUtil::get_capabilities();

		$our_cap_cats = array();

		foreach ( $cap_cats as $category => $funcinfo ) {

			sort( $funcinfo['funcs'] );
			foreach	( $funcinfo['funcs'] as $func ) {
				if ( in_array( strtolower( $func ), $our_caps ) ) {
					$our_cap_cats[ $category ]['funcs'][] = $func;
				}
			}

			if ( !empty( $our_cap_cats[ $category ] ) ) {
				$our_cap_cats[ $category ][ 'label' ] = $funcinfo[ 'label' ];
				$our_cap_cats[ $category ][ 'desc' ] = $funcinfo[ 'desc' ];
			}
		}

		return $our_cap_cats;
	}

	/**
	 * Set up our filters
	 */
	protected function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_ajax_delete_tables', array( $this, 'ajax_delete_tables' ) );
		add_action( 'wp_ajax_create_tables', array( $this, 'ajax_create_tables' ) );
		add_action( 'wp_ajax_truncate_tables', array( $this, 'ajax_truncate_tables' ) );
		add_action( 'wp_ajax_populate_tables', array( $this, 'ajax_populate_tables' ) );
	}

	/**
	 * Add the dashboard menu listing.
	 */
	public function admin_menu() {
		add_management_page( esc_html__( 'WP GeoMeta', 'wp-geometa' ), esc_html__( 'WP GeoMeta','wp-geometa' ), 'install_plugins', 'wp-geometa', array( $this, 'show_dashboard' ) );
	}

	public function show_dashboard() {
		require_once( dirname( __FILE__ ) . '/dash.inc' );
	}

	public function ajax_delete_tables() {

	}

	public function ajax_create_tables() {

	}

	public function ajax_truncate_tables() {

	}

	public function ajax_populate_tables() {

	}

	public function make_table_list_block() {
		/*
			$geometa = WP_GeoMeta::get_instance();
			foreach( $geometa->meta_types as $meta_type ) {
			$geotable = _get_meta_table( $meta_type ) . '_geo';
			if ( $geotable !== $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', array( $geotable ) ) ) ) {
			continue;
			}
			$create = $wpdb->get_var( 'SHOW CREATE TABLE `' . $geotable . '`', 1 );
			$has_spatial_index = ( false !== strpos( $create, 'SPATIAL KEY `meta_val_spatial_idx` (`meta_value`)' ) ? 'TRUE' : 'FALSE' ); 

			$num_records = $wpdb->get_var( 'SELECT COUNT(*) FROM `' . $geotable . '`' );

			print '<tr><td>' . $geotable . '</td><td>' . $has_spatial_index . '</td><td>' . $num_records . '</td></tr>';
		 */
	
	}

	public function make_db_version_block() {
		global $wpdb;

		$our_caps = WP_GeoUtil::get_capabilities();
		$version_info = $wpdb->get_var( 'SELECT VERSION()' ); // @codingStandardsIgnoreLine

		if ( in_array( 'st_intersects', $our_caps ) ) {
			return $this->make_status_block( 'good', 'Good Database!', 'Your database version (' . $version_info . ') supports a wide variety of useful spatial functions.');
		} else if ( in_array( 'geometrycollection', $our_caps ) ) {
			return $this->make_status_block( 'fair', 'OK Database', 'Your database version (' . $version_info . ') has some spatial support, but doesn\'t support key spatial functions. Consider upgrading to MySQL 5.6.1 or higher, or MariaDB 5.3.3 or higher.');
		} else {
			return $this->make_status_block( 'bad', 'Bad Database', 'Your database version (' . $version_info . ') doesn\'t appear to have spatial support. You won\'t be able to store or use spatial data.');
		}
	}

	public function make_update_block() {

		$all_plugins = get_plugin_updates();

		$this_plugin = basename( dirname( dirname( __FILE__ ) ) ) . '/wp-geometa.php';

		/*
		 * Three statuses. 
		 * Bad. There are updates and WP_GEOMETA_DASH_VERSION and WP_GEOMETA_VERSION are the same and both are out of date
		 * OK. There are updates, and WP_GEOMETA_DASH_VERSION is out of date, but WP_GEOMETA_VERSION is up to date (some other plugin has an updated version)
		 * Good. There are no updates: WP_GEOMETA_DASH_VERSION is up to date and WP_GEOMETA_VERSION is up to date
		 */

		if ( empty( $all_plugins[ $this_plugin ] ) ) {
			return $this->make_status_block( 'good', 'Up to date!', 'You are running the most recent version of WP-GeoMeta (' . WP_GEOMETA_VERSION . ')');
		} else if ( 0 === version_compare( WP_GEOMETA_VERSION, $all_plugins[ $this_plugin ]->Version ) && -1 === version_compare( WP_GEOMETA_DASH_VERSION, $all_plugins[ $this_plugin ]->Version ) ) {
			return $this->make_status_block( 'fair', 'Out of date.', 'A plugin you are using is providing the most recent version of the WP-GeoMeta library (' . WP_GEOMETA_VERSION . '), but your plugin is out of date.');
		} else {
			return $this->make_status_block( 'bad', 'Out of date!', 'You are running an outdated version of WP-GeoMeta (' . WP_GEOMETA_VERSION . '). Please upgrade!');
		}
	} 

	public function make_status_block($status, $title, $description){

		$block = '<div class="status-block">
				<div class="status-circle ' . $status . '"></div>
				<div class="status-title">' . $title . '</div>
				<div class="status-text">' . $description . '</div>
			</div>';
		return $block;
	}
}