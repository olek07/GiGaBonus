<?php
namespace In2code\Powermail\Tests\Fixtures\Domain\Service;

use In2code\Powermail\Domain\Service\RedirectUriService;

/**
 * Class RedirectUriServiceFixture
 * @package In2code\Powermail\Tests\Fixtures\Domain\Service
 */
class RedirectUriServiceFixture extends RedirectUriService
{

    /**
     * @var array
     */
    protected $typoScriptFixture = [];

    /**
     * @var array
     */
    protected $flexFormFixture = [];

    /**
     * Get typoscript
     *
     * @return array
     */
    protected function getOverwriteTypoScript()
    {
        return $this->typoScriptFixture;
    }

    protected function getFlexFormArray()
    {
        return $this->flexFormFixture;
    }
}
