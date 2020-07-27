<?php

namespace ConeyQodef\Modules\Shortcodes\Lib;

use ConeyQodef\Modules\Shortcodes\Accordion\Accordion;
use ConeyQodef\Modules\Shortcodes\AccordionTab\AccordionTab;
use ConeyQodef\Modules\Shortcodes\AnimationHolder\AnimationHolder;
use ConeyQodef\Modules\Shortcodes\Banner\Banner;
use ConeyQodef\Modules\Shortcodes\BlogCategory\BlogCategory;
use ConeyQodef\Modules\Shortcodes\BlogList\BlogList;
use ConeyQodef\Modules\Shortcodes\BlogPostCalendar\BlogPostCalendar;
use ConeyQodef\Modules\Shortcodes\BlogSlider\BlogSlider;
use ConeyQodef\Modules\Shortcodes\BlogVideoList\BlogVideoList;
use ConeyQodef\Modules\Shortcodes\Button\Button;
use ConeyQodef\Modules\Shortcodes\CallToAction\CallToAction;
use ConeyQodef\Modules\Shortcodes\Client\Client;
use ConeyQodef\Modules\Shortcodes\Clients\Clients;
use ConeyQodef\Modules\Shortcodes\ClientsCarousel\ClientsCarousel;
use ConeyQodef\Modules\Shortcodes\ClientsCarouselItem\ClientsCarouselItem;
use ConeyQodef\Modules\Shortcodes\CoverBoxes\CoverBoxes;
use ConeyQodef\Modules\Shortcodes\CustomFont\CustomFont;
use ConeyQodef\Modules\Shortcodes\Dropcaps\Dropcaps;
use ConeyQodef\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use ConeyQodef\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use ConeyQodef\Modules\Shortcodes\GoogleMap\GoogleMap;
use ConeyQodef\Modules\Shortcodes\Highlight\Highlight;
use ConeyQodef\Modules\Shortcodes\Icon\Icon;
use ConeyQodef\Modules\Shortcodes\IconListItem\IconListItem;
use ConeyQodef\Modules\Shortcodes\IconWithText\IconWithText;
use ConeyQodef\Modules\Shortcodes\ImageGallery\ImageGallery;
use ConeyQodef\Modules\Shortcodes\ImageWithText\ImageWithText;
use ConeyQodef\Modules\Shortcodes\InfoBox\InfoBox;
use ConeyQodef\Modules\Shortcodes\Parallax\Parallax;
use ConeyQodef\Modules\Shortcodes\PricingTables\PricingTables;
use ConeyQodef\Modules\Shortcodes\PricingTable\PricingTable;
use ConeyQodef\Modules\Shortcodes\ProgressBar\ProgressBar;
use ConeyQodef\Modules\Shortcodes\SectionTitle\SectionTitle;
use ConeyQodef\Modules\Shortcodes\Separator\Separator;
use ConeyQodef\Modules\Shortcodes\SingleImage\SingleImage;
use ConeyQodef\Modules\Shortcodes\SocialShare\SocialShare;
use ConeyQodef\Modules\Shortcodes\Tabs\Tabs;
use ConeyQodef\Modules\Shortcodes\Tab\Tab;
use ConeyQodef\Modules\Shortcodes\Team\Team;
use ConeyQodef\Modules\Shortcodes\VideoButton\VideoButton;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 *
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode( ShortcodeInterface $shortcode ) {
		if ( ! array_key_exists( $shortcode->getBase(), $this->loadedShortcodes ) ) {
			$this->loadedShortcodes[ $shortcode->getBase() ] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode( new Accordion() );
		$this->addShortcode( new AccordionTab() );
		$this->addShortcode( new AnimationHolder() );
		$this->addShortcode( new Banner() );
		$this->addShortcode( new BlogCategory() );
		$this->addShortcode( new BlogList() );
		$this->addShortcode( new BlogPostCalendar() );
		$this->addShortcode( new BlogSlider() );
		$this->addShortcode( new BlogVideoList() );
		$this->addShortcode( new Button() );
		$this->addShortcode( new CallToAction() );
		$this->addShortcode( new ClientsCarousel() );
		$this->addShortcode( new ClientsCarouselItem() );
		$this->addShortcode( new Clients() );
		$this->addShortcode( new Client() );
		$this->addShortcode( new CoverBoxes() );
		$this->addShortcode( new CustomFont() );
		$this->addShortcode( new Dropcaps() );
		$this->addShortcode( new ElementsHolder() );
		$this->addShortcode( new ElementsHolderItem() );
		$this->addShortcode( new GoogleMap() );
		$this->addShortcode( new Highlight() );
		$this->addShortcode( new Icon() );
		$this->addShortcode( new IconListItem() );
		$this->addShortcode( new IconWithText() );
		$this->addShortcode( new ImageGallery() );
		$this->addShortcode( new ImageWithText() );
		$this->addShortcode( new InfoBox() );
		$this->addShortcode( new Parallax() );
		$this->addShortcode( new PricingTables() );
		$this->addShortcode( new PricingTable() );
		$this->addShortcode( new ProgressBar() );
		$this->addShortcode( new SectionTitle() );
		$this->addShortcode( new Separator() );
		$this->addShortcode( new SingleImage() );
		$this->addShortcode( new SocialShare() );
		$this->addShortcode( new Tabs() );
		$this->addShortcode( new Tab() );
		$this->addShortcode( new Team() );
		$this->addShortcode( new VideoButton() );
	}

	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ( $this->loadedShortcodes as $shortcode ) {
			add_shortcode( $shortcode->getBase(), array( $shortcode, 'render' ) );
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();