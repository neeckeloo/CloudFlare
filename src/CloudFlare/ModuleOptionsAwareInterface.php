<?php
namespace CloudFlare;

interface ModuleOptionsAwareInterface
{
    /**
     * @param ModuleOptions $options
     */
    public function setModuleOptions(ModuleOptions $options);
}