<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .bus-layout {
            display: inline-block;
            margin-top: 20px;
        }
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            text-align: center;
            line-height: 40px;
            border: 1px solid #333;
            display: inline-block;
            cursor: pointer;
            background-color: #ddd;
        }
        .seat.selected {
            background-color: green;
            color: white;
        }
        .seat.booked {
            background-color: red;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <h2>Bus Seat Booking</h2>
    <p>Click on a seat to select/deselect</p>

    <div class="bus-layout">
        <script>
            let bookedSeats = [2, 5, 10]; // Example of booked seats (can be fetched from DB)
            for (let i = 1; i <= 20; i++) { // 20 seats
                document.write(<div class="seat ${bookedSeats.includes(i) ? 'booked' : ''}" onclick="toggleSeat(this, ${i})">${i}</div>);
                if (i % 4 === 0) document.write('<br>'); // 4 seats per row
            }
        </script>
    </div>

    <h3>Selected Seats:</h3>
    <p id="selected-seats">None</p>

    <script>
        let selectedSeats = [];

        function toggleSeat(seat, seatNumber) {
            if (seat.classList.contains('booked')) return;

            if (seat.classList.contains('selected')) {
                seat.classList.remove('selected');
                selectedSeats = selectedSeats.filter(num => num !== seatNumber);
            } else {
                seat.classList.add('selected');
                selectedSeats.push(seatNumber);
            }

            document.getElementById('selected-seats').innerText = selectedSeats.length ? selectedSeats.join(', ') : 'None';
        }
    </script>

</body>
</html>