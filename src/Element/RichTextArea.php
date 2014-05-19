<?php
/**
 * This file is part of Vegas package
 *
 * @author Arkadiusz Ostrycharz <arkadiusz.ostrycharz@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Vegas\Forms\Element;

use \Vegas\Forms\Element\Exception\InvalidAssetsManagerException;

class RichTextArea extends \Phalcon\Forms\Element\TextArea implements AssetsInjectableInterface
{
    private $assets;
    
    /**
     * Constructs rich text area (ckeditor)
     *
     * @param string $name
     * @param null $attributes
     */
    public function __construct($name, $attributes = null)
    {
        $attributes['vegas-richtext'] = true;
        parent::__construct($name, $attributes);
    }
    
    public function render($attributes = null)
    {
        $this->addAssets();
        return parent::render($attributes);
    }
    
    private function addAssets()
    {
        if(!$this->assets) {
            throw new InvalidAssetsManagerException();
        }

        $this->assets->addCss('assets/vendor/jquery-ui/themes/base/jquery-ui.css');
        $this->assets->addCss('assets/vendor/el-finder/src/elfinder/css/elfinder.css');

        $this->assets->addJs('assets/vendor/ckeditor/ckeditor.js');
        $this->assets->addJs('assets/vendor/ckeditor/adapters/jquery.js');
        $this->assets->addJs('assets/js/lib/vegas/ui/richtext.js');
    }
    
    public function getAssetsManager()
    {
        return $this->assets;
    }

    public function setAssetsManager(\Phalcon\Assets\Manager $assets)
    {
        $this->assets = $assets;
        
        return $this;
    }
}
