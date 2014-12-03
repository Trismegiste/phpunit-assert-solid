<?php

/*
 * phpunit-solid-assertion
 */

namespace tests\Trismegiste\SolidAssert\Visitor;

use Trismegiste\SolidAssert\Visitor\MissingTypeHint;

/**
 * MissingTypeHintTest tests the MissingTypeHint visitor
 */
class MissingTypeHintTest extends VisitorTestCase
{

    protected function createVisitor()
    {
        return new MissingTypeHint();
    }

    public function getNoMissingHint()
    {
        return [
            ['class Swag { function yolo() { $this->call1(); }}'],
            ['class Swag { function yolo(\Iterator $obj) { $obj->next(); }}'],
            ['class Swag { function yolo() { $obj->count(); }}'],
            ['class Swag { function yolo(&$n) { $n++; }}']
        ];
    }

    /**
     * @dataProvider getNoMissingHint
     */
    public function testNoMissingHint($code)
    {
        
    }

    public function testMissing()
    {
        $code = 'class Swag { function yolo($obj) { $obj->call1(); }}';
        $this->parseAndTraversePhp($code);
        $report = $this->sut->getReport();
        $this->assertCount(1, $report);
        $this->assertRegexp('#parameter \$obj.+at line#', $report[0]);
    }

}