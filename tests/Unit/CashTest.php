<?php

namespace Tests\Unit;

use Tests\TestCase;

class CashTest extends TestCase
{
    public function testCashSuccess()
    {
        $this->post('/api/cash', ['amount' => 250])
            ->assertSuccessful()
            ->assertSee('[100,100,50]');

        $this->post('/api/cash', ['amount' => 180])
            ->assertSuccessful()
            ->assertSee('[100,50,20,10]');

        $this->post('/api/cash', ['amount' => 30])
            ->assertSuccessful()
            ->assertSee('[20,10]');

        $this->post('/api/cash', ['amount' => 80])
            ->assertSuccessful()
            ->assertSee('[50,20,10]');
        
        $this->post('/api/cash')
            ->assertSuccessful()
            ->assertSee('[]');
    }

    public function testCashErrors() {
        $this->post('/api/cash', ['amount' => 125])
            ->assertStatus(500);

        $this->post('/api/cash', ['amount' => -130])
            ->assertStatus(500);
    }
}
