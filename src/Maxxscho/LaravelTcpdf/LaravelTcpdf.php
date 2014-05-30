<?php namespace Maxxscho\LaravelTcpdf;

use \TCPDF;
use Config;


class LaravelTcpdf extends TCPDF
{

    /**
     * TCPDF system constants that map to settings in our config file
     *
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
     *
     * @author Markus Schober
     */
    public function __construct()
    {
        // Initialize TCPDF
        parent::__construct(
            Config::get('laravel-tcpdf::page_orientation'),
            Config::get('laravel-tcpdf::page_unit'),
            Config::get('laravel-tcpdf::page_format'),
            Config::get('laravel-tcpdf::unicode'),
            Config::get('laravel-tcpdf::encoding'),
            Config::get('laravel-tcpdf::enable_disk_cache')
        );

        // default margin settings
        $this->SetMargins(
            Config::get('laravel-tcpdf::margin_left'),
            Config::get('laravel-tcpdf::margin_top'),
            Config::get('laravel-tcpdf::margin_right')
        );

        // default header setting
        $this->headerSettings();

        // default footer settings
        $this->footerSettings();

        // default page break settings
        $this->SetAutoPageBreak(
            Config::get('laravel-tcpdf::page_break_auto'),
            Config::get('laravel-tcpdf::footer_margin')
        );

        // default cell settings
        $this->cellSettings();

        // default document properties
        $this->setDocumentProperties();

        // default page font
        $this->setFont(
            Config::get('laravel-tcpdf::page_font'),
            '',
            Config::get('laravel-tcpdf::page_font_size')
        );

        // default image scale
        $this->setImageScale(Config::get('laravel-tcpdf::image_scale'));
    }



    /**
     * Set all the necessary header settings
     *
     * @author Markus Schober
     */
    protected function headerSettings()
    {
        $this->setPrintHeader(
            Config::get('laravel-tcpdf::header_on')
        );

        $this->setHeaderFont(array(
            Config::get('laravel-tcpdf::header_font'),
            '',
            Config::get('laravel-tcpdf::header_font_size')
        ));

        $this->setHeaderMargin(
            Config::get('laravel-tcpdf::header_margin')
        );

        $this->SetHeaderData(
            Config::get('laravel-tcpdf::header_logo'),
            Config::get('laravel-tcpdf::header_logo_width'),
            Config::get('laravel-tcpdf::header_title'),
            Config::get('laravel-tcpdf::header_string')
        );
    }



    /**
     * Set all the necessary footer settings
     *
     * @author Markus Schober
     */
    protected function footerSettings()
    {
        $this->setPrintFooter(
            Config::get('laravel-tcpdf::footer_on')
        );

        $this->setFooterFont(array(
            Config::get('laravel-tcpdf::footer_font'),
            '',
            Config::get('laravel-tcpdf::footer_font_size')
        ));

        $this->setFooterMargin(
            Config::get('laravel-tcpdf::footer_margin')
        );
    }



    /**
     * Set the default cell settings
     *
     * @author Markus Schober
     */
    protected function cellSettings()
    {
        $this->SetCellPadding(
            Config::get('laravel-tcpdf::cell_padding')
        );

        $this->setCellHeightRatio(
            Config::get('laravel-tcpdf::cell_height_ratio')
        );
    }



    /**
     * Set default document properties
     *
     * @author Markus Schober
     */
    protected function setDocumentProperties()
    {
        $this->SetCreator(Config::get('laravel-tcpdf::creator'));
        $this->SetAuthor(Config::get('laravel-tcpdf::author'));
    }

}