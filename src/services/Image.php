<?php
/**
 * Imageshop plugin for Craft CMS 3.x
 *
 * Integrate with an Imageshop account and use Imageshop resources in Craft
 *
 * @link      https://vangenplotz.no/
 * @copyright Copyright (c) 2018 Vangen & Plotz AS
 */

namespace vangenplotz\imageshop\services;

use vangenplotz\imageshop\Imageshop;

use Craft;
use craft\base\Component;
use vangenplotz\imageshop\models\ImageModel;

/**
 * Image Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Vangen & Plotz AS
 * @package   Imageshop
 * @since     0.0.1
 */
class Image extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Transform the image, and return an image model
     *
     * From any other plugin file, call it like this:
     *
     *     Imageshop::$plugin->image->transformImage($documentId, $transforms)
     *
     * @return ImageModel
     */
    public function transformImage($documentId = null, $transforms = [], $defaultOptions = [])
    {
        if( !$documentId ) {
            return null;
        }

        return new ImageModel($documentId, $transforms, $defaultOptions);
    }

    /**
     * Get the image data for the document Id
     *
     * From any other plugin file, call it like this:
     *
     *     Imageshop::$plugin->image->getImageData($documentId)
     *
     * @return simpleXML
     */
    public function getImageData($documentId = null)
    {
        if( !$documentId ) {
            return null;
        }

        return Imageshop::$plugin->soap->getImageData($documentId)->GetDocumentByIdResponse->GetDocumentByIdResult;

    }
    /**
     * Get image transform permalink with document id, width and height
     *
     * From any other plugin file, call it like this:
     *
     *     Imageshop::$plugin->image->getImageTransform($documentId, $width, $height)
     *
     * @return simpleXML
     */
    public function getImageTransform($documentId = null, $width = null, $height = null)
    {

        if( !$documentId || !$width || !$height ) {
            return null;
        }

        return Imageshop::$plugin->soap->getImagePermalink($documentId, $width, $height);

    }


}
