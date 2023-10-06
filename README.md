Bicycle Test

To run:
1. execute `symfony server:start`
2. navigate to `localhost:8000/run_test`
3. see the results from `BikeController::runTest()`


There is a `Bike` class and an `ElectricBike` class that extended from `Bike`. Factories are implemented for generating new Bikes. Bikes can be pedalled and Electric bikes can both be pedalled and have power from the battery used to rotate the wheels.

Bikes are pedalled over a `$delta` timeframe in seconds at some `$throttle` between 0 and 1 to travel some calculated distance. Additionally, bikes can change gears to increase the number of tire rotations per full pedal. The gear is changed with `shift_up()` and `shift_down()`.