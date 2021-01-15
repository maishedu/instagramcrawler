<?php namespace Kent\InstagramCrawler\Components;

use Kent\InstagramCrawler\autoload;
use Cms\Classes\ComponentBase;
use Kent\InstagramCrawler\Models\Settings;
use InstagramScraper\Instagram;

class TagFeed extends ComponentBase
{
    public $media;

    public function componentDetails()
    {
        return [
            'name'        => 'Tag Feed',
            'description' => 'Instagram media based on a specified tag.'
        ];
    }

    public function defineProperties()
    {
        return [
            'tag' => [
                'title'             => 'Tag',
                'description'       => 'The tag on which to retrieve media.',
                'type'              => 'string',
                'validationPattern' => '^(?=\s*\S).*$',
                'validationMessage' => 'The Tag property is required'
            ],
            'limit' => [
                'title'             => 'Limit',
                'description'       => 'The number of media to be displayed (20 maximum).',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The Limit property should be numeric'
            ],
            'cache' => [
                'title'             => 'Cache',
                'description'       => 'The number of minutes to cache the media.',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The Cache property should be numeric'
            ]
        ];
    }

    public function onRun()
    {
      $api = new Instagram();
      $this->media = $this->page['media'] = $api->getMediasByTag($this->property('tag'),  (int)$this->property('limit'));
    }
}
