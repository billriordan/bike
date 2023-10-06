<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Factory\BikeFactory;
use App\Factory\ElectricBikeFactory;

class BikeController extends AbstractController
{
    public function runTest()
    {
        $seconds = 60;
        $red_bike = BikeFactory::create(['color' => 'red']);
        $red_bike->pedal($seconds, 1);

        $blue_bike = BikeFactory::create(['color' => 'blue']);
        $blue_bike->pedal($seconds / 2, 1);
        $blue_bike->shift_up();
        $blue_bike->pedal($seconds - ($seconds / 2), 1);

        $orange_bike = BikeFactory::create(['color' => 'orange']); 
        $orange_bike->shift_up();
        $orange_bike->pedal($seconds, 1);
        
        $electric_bike = ElectricBikeFactory::create(['color' => 'green']);
        $electric_bike->draw_power($seconds, 1);
        
        return $this->render('test.html.twig', [
                'bikes' => [$red_bike, $blue_bike, $orange_bike, $electric_bike],
                'seconds' => $seconds,
            ]);
    }
}