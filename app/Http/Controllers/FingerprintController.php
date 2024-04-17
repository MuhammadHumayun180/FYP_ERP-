<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Fingerprint\ZKTeco\ZKTeco; // Adjust this according to the actual namespace
use App\Models\FingerDevice;
use App\Models\Attendance;

class FingerprintController extends Controller
{
        public function getAttendance(Request $request)
        {
            $fingerDevice = FingerDevice::find($request->input('finger_device_id'));
            $device = new ZKTeco($fingerDevice->ip, 4370);

            $device->connect();
            $data = $device->getAttendance();

            foreach ($data as $value) {
                $this->saveAttendance($fingerDevice->id, $value);
            }

            flash()->success('Success', 'Attendance Queue will run in a minute!');

            return back();
        }

        private function saveAttendance($fingerDeviceId, $attendanceData)
        {
            Attendance::create([
                'finger_device_id' => $fingerDeviceId,
                'uid' => $attendanceData['uid'],
                'emp_id' => $attendanceData['id'],
                'state' => $attendanceData['state'],
                'attendance_time' => date('H:i:s', strtotime($attendanceData['timestamp'])),
                'attendance_date' => date('Y-m-d', strtotime($attendanceData['timestamp'])),
                'type' => $attendanceData['type'],
                'status' => $this->calculateAttendanceStatus($attendanceData),
            ]);
        }

        private function calculateAttendanceStatus($attendanceData)
        {
            // Implement your logic to calculate attendance status (e.g., lateness)
            // Example: If the timestamp is later than the expected time_in, mark as late
            return ($attendanceData['timestamp'] > $expectedTimeIn) ? 0 : 1;
        }
}
