<?php namespace Maxxscho\LaravelTcpdf;

use \TCPDF;
use Config;


class LaravelTcpdf {

    /**
     * TCPDF Object
     * @var Object
     */
    protected $tcpdf;

    /**
     * TCPDF system constants that map to settings in our config file
     * @var array
     */
    private $config_constant_map = [
        'K_PATH_CACHE'  => 'cache_directory',
        'K_PATH_IMAGES' => 'image_directory',
        'K_BLANK_IMAGE' => 'blank_image',
        'K_SMALL_RATIO' => 'small_font_ratio'
    ];


    /**
     * Constructor
     * @author Markus Schober
     */
    public function __construct()
    {
        /* override the default TCPDF config file
        ------------------------------------- */
        if(!defined('K_TCPDF_EXTERNAL_CONFIG')) {   
            define('K_TCPDF_EXTERNAL_CONFIG', TRUE);
        }

        // set TCPDF system constants
        $this->setTcpdfConstants();
        
        // Initialize TCPDF
        $this->tcpdf = new TCPDF(
            Config::get('laravel-tcpdf::page_orientation'),
            Config::get('laravel-tcpdf::page_unit'),
            Config::get('laravel-tcpdf::page_format'),
            Config::get('laravel-tcpdf::unicode'),
            Config::get('laravel-tcpdf::encoding'),
            Config::get('laravel-tcpdf::enable_disk_cache')
        );

        // default margin settings
        $this->marginSettings();

        // default header setting
        $this->headerSettings();

        // default footer settings
        $this->footerSettings();

        // default page break settings
        $this->pageBreak();

        // default cell settings
        $this->cellSettings();

        // default document properties
        $this->setDocumentProperties();

        // default page font
        $this->setFont();

        // default image scale
        $this->setImageScale();
    }


    /**
     * Set some TCPDF system based on our config file
     * @author Markus Schober
     */
    protected function setTcpdfConstants()
    {
        foreach( $this->config_constant_map as $const => $configkey ) {
            if( !defined( $const ) ) {
                if( is_string( Config::get('laravel-tcpdf::' . $configkey) ) ) {
                    if( strlen( Config::get('laravel-tcpdf::' . $configkey) ) > 0 ) {
                        define( $const, Config::get('laravel-tcpdf::' . $configkey) );
                    }
                }
                else {
                    define( $const, Config::get('laravel-tcpdf::' . $configkey) );
                }
            }
        }
    }


    /**
     * set page margins
     * @author Markus Schober
     */
    protected function marginSettings()
    {
        $this->tcpdf->SetMargins(
            Config::get('laravel-tcpdf::margin_left'),
            Config::get('laravel-tcpdf::margin_top'),
            Config::get('laravel-tcpdf::margin_right')
        );
    }


    /**
     * Set all the necessary header settings
     * @author Markus Schober
     */
    protected function headerSettings()
    {
        $this->tcpdf->setPrintHeader(
            Config::get('laravel-tcpdf::header_on')
        );

        $this->tcpdf->setHeaderFont(array(
            Config::get('laravel-tcpdf::header_font'),
            '',
            Config::get('laravel-tcpdf::header_font_size')
        ));

        $this->tcpdf->setHeaderMargin(
            Config::get('laravel-tcpdf::header_margin')
        );

        $this->tcpdf->SetHeaderData(
            Config::get('laravel-tcpdf::header_logo'),
            Config::get('laravel-tcpdf::header_logo_width'),
            Config::get('laravel-tcpdf::header_title'),
            Config::get('laravel-tcpdf::header_string')
        );
    }


    /**
     * Set all the necessary footer settings
     * @author Markus Schober
     */
    protected function footerSettings()
    {
        $this->tcpdf->setPrintFooter(
            Config::get('laravel-tcpdf::footer_on')
        );

        $this->tcpdf->setFooterFont(array(
            Config::get('laravel-tcpdf::footer_font'),
            '',
            Config::get('laravel-tcpdf::footer_font_size')
        ));

        $this->tcpdf->setFooterMargin(
            Config::get('laravel-tcpdf::footer_margin')
        );
    }


    /**
     * Set the default auto pagebreak
     * @author Markus Schober
     */
    protected function pageBreak()
    {
        $this->tcpdf->SetAutoPageBreak(
            Config::get('laravel-tcpdf::page_break_auto'),
            Config::get('laravel-tcpdf::footer_margin')
        );
    }


    /**
     * Set the default cell settings
     * @author Markus Schober
     */
    protected function cellSettings()
    {
        $this->tcpdf->SetCellPadding(
            Config::get('laravel-tcpdf::cell_padding')
        );

        $this->tcpdf->setCellHeightRatio(
            Config::get('laravel-tcpdf::cell_height_ratio')
        );
    }


    /**
     * Set default document properties
     * @author Markus Schober
     */
    protected function setDocumentProperties()
    {
        $this->tcpdf->SetCreator( Config::get('laravel-tcpdf::creator') );
        $this->tcpdf->SetAuthor( Config::get('laravel-tcpdf::author') );
    }


    /**
     * Set the default page font
     * @author Markus Schober
     */
    protected function setFont()
    {
        $this->tcpdf->setFont(
            Config::get('laravel-tcpdf::page_font'),
            '',
            Config::get('laravel-tcpdf::page_font_size')
        );
    }


    /**
     * Set default image scale
     * @author Markus Schober
     */
    protected function setImageScale()
    {
        $this->tcpdf->setImageScale( Config::get('laravel-tcpdf::image_scale') );
    }


    /**
     * Handle dynamic method call
     * @param  string $name
     * @param  array $args
     */
    public function __call($name, $args)
    {
        $args = empty($args) ? [] : $args;

        return call_user_func_array(array($this->tcpdf, $name), $args);
    }

}