<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fingerprint Attendance</title>
</head>
<body>
    <form action="{{ url('/get-attendance') }}" method="post">
        @csrf
        <label for="finger_device_id">Select Fingerprint Device:</label>
        <select name="finger_device_id" id="finger_device_id">
            @foreach ($fingerDevices as $device)
                <option value="{{ $device->id }}">{{ $device->ip }}</option>
            @endforeach
        </select>
        <button type="submit">Get Attendance</button>
    </form>
</body
