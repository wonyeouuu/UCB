<?php

namespace App\Repositories;

use DB;
use Auth;
use App\Alert;
use App\Reminder;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Input;

Class ReminderRepository
{
    public static function make()
    {
        return new static;
    }

    public function all()
    {
        return Auth::user()->reminders()->with('alerts')->get();
    }

    public function create()
    {
        DB::beginTransaction();
        try {
            //create reminder
            $reminder = Reminder::create(array_merge(Input::all(), ['user_id' => Auth::user()->id]));
            $startAt = Carbon::parse(Input::get('start_at'))->startOfDay();
            $endAt = Carbon::parse(Input::get('end_at'))->endOfDay();
            $times = [];
            switch(Input::get('frequency')) {
                case Reminder::$FREQUENCY_EVERYDAY:
                    $interval = $this->toInterval(Input::get('times')[0]);
                    $times[] = $startAt->copy()->add($interval);
                    while($startAt->addDay() < $endAt) {
                        $times[] = $startAt->copy()->add($interval);
                    }
                    break;
                case Reminder::$FREQUENCY_TWICEADAY:
                    $interval1 = $this->toInterval(Input::get('times')[0]);
                    $interval2 = $this->toInterval(Input::get('times')[1]);
                    $times[] = $startAt->copy()->add($interval1);
                    $times[] = $startAt->copy()->add($interval2);
                    while($startAt->addDay() < $endAt) {
                        $times[] = $startAt->copy()->add($interval1);
                        $times[] = $startAt->copy()->add($interval2);
                    }
                    break;
                case Reminder::$FREQUENCY_THREETIMESADAY:
                    $interval1 = $this->toInterval(Input::get('times')[0]);
                    $interval2 = $this->toInterval(Input::get('times')[1]);
                    $interval3 = $this->toInterval(Input::get('times')[2]);
                    $times[] = $startAt->copy()->add($interval1);
                    $times[] = $startAt->copy()->add($interval2);
                    $times[] = $startAt->copy()->add($interval3);
                    while($startAt->addDay() < $endAt) {
                        $times[] = $startAt->copy()->add($interval1);
                        $times[] = $startAt->copy()->add($interval2);
                        $times[] = $startAt->copy()->add($interval3);
                    }
                    break;
                case Reminder::$FREQUENCY_FOURTIMESADAY:
                    $interval1 = $this->toInterval(Input::get('times')[0]);
                    $interval2 = $this->toInterval(Input::get('times')[1]);
                    $interval3 = $this->toInterval(Input::get('times')[2]);
                    $interval4 = $this->toInterval(Input::get('times')[3]);
                    $times[] = $startAt->copy()->add($interval1);
                    $times[] = $startAt->copy()->add($interval2);
                    $times[] = $startAt->copy()->add($interval3);
                    $times[] = $startAt->copy()->add($interval4);
                    while($startAt->addDay() < $endAt) {
                        $times[] = $startAt->copy()->add($interval1);
                        $times[] = $startAt->copy()->add($interval2);
                        $times[] = $startAt->copy()->add($interval3);
                        $times[] = $startAt->copy()->add($interval4);
                    }
                    break;
            }
            //create alert
            collect($times)->each(function($time) use ($reminder) {
                Alert::create([
                    'reminder_id' => $reminder->id,
                    'alert_at' => $time
                ]);
            });

            DB::commit();
            return [
                'success' => 1,
                'message' => 'Create Success.'
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'success' => 0,
                'message' => 'Failed.'
            ];
        }
    }

    public function update($id)
    {
        // Record::find($id)->update(Input::all());
        // return [
        //     'success' => 1,
        //     'message' => 'Success.'
        // ];
    }

    public function show($id)
    {
        return Reminder::with('alerts')->find($id);
    }

    protected function toInterval($timeStr)
    {
        $time = Carbon::parse($timeStr);
        return CarbonInterval::create(0, 0, 0, 0, $time->hour, $time->minute, $time->second);
    }

    public function delete($id)
    {
        $reminder = Reminder::find($id);
        if ($reminder->user_id != Auth::user()->id) {
            return [
                'success' => '0',
                'message' => 'Unauthrorized.'
            ];
        }
        DB::beginTransaction();
        try {
            $reminder->alerts()->delete();
            $reminder->delete();
            DB::commit();
            return [
                'success' => '1',
                'message' => 'Success.'
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'success' => '0',
                'message' => 'Failed.'
            ];
        }
    }
}
