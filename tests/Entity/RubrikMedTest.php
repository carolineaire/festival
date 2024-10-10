<?php

namespace App\Tests\Entity;

use App\Entity\RubrikMed;
use App\Entity\Media;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class RubrikMedTest extends TestCase
{
    public function testGetSetId()
    {
        $rubrikMed = new RubrikMed();
        $this->assertNull($rubrikMed->getId());
    }

    public function testGetSetName()
    {
        $rubrikMed = new RubrikMed();
        $name = 'Test Name';
        $rubrikMed->setName($name);

        $this->assertEquals($name, $rubrikMed->getName());
    }

    public function testGetMedia()
    {
        $rubrikMed = new RubrikMed();
        $this->assertInstanceOf(Collection::class, $rubrikMed->getMedia());
    }

    public function testAddMedium()
    {
        $rubrikMed = new RubrikMed();
        $media = $this->createMock(Media::class);
        $media = $this->getMockBuilder(Media::class)
                      ->disableOriginalConstructor()
                      ->getMock();
        $media->method('setRubrikMed')
              ->with($rubrikMed);

        $rubrikMed->addMedium($media instanceof Media ? $media : null);

        $this->assertTrue($rubrikMed->getMedia()->contains($media));
    }

    public function testRemoveMedium()
    {
        $rubrikMed = new RubrikMed();
        $media = $this->createMock(Media::class);
        $media->expects($this->once())
            ->method('setRubrikMed')
            ->with($this->isNull());

        $rubrikMed->addMedium($media instanceof Media ? $media : null);
        $rubrikMed->removeMedium($media instanceof Media ? $media : null);

        $this->assertFalse($rubrikMed->getMedia()->contains($media));
    }

    public function testToString()
    {
        $rubrikMed = new RubrikMed();
        $name = 'Test Name';
        $rubrikMed->setName($name);

        $this->assertEquals($name, (string) $rubrikMed);
    }
}
?>
