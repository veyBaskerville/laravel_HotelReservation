<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap">
    <style>
        body {
            background-image: url("{{ asset('images/bggg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            background: #2C261E;
            padding: 10px 20px;
            align-items: center;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 24px;
            color: white;
            font-family: 'Cormorant Garamond', serif;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 20px;
            font-family: 'Cormorant Garamond', serif;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            margin-top: 120px;
            background-color: rgba(38, 36, 36, 0.6);
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 1500px;
            margin-left: auto;
            margin-right: auto;
        }
        h1 {
            text-align: center;
            font-family: 'Cormorant Garamond', serif;
            font-size: 40px;
            color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        table, th, td {
            border: 1px solid #fff;
            color: white;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-edit {
            background-color:rgb(231, 174, 108);
            color: white;
        }
        .btn-delete {
            background-color: #DC3545;
            color: white;
        }
        .btn-add {
            background-color: #6D4C41;
            color: white;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 16px;
            float: right;
        }
        a.btn {
            text-decoration: none;
        }
        .btn:hover {
            filter: brightness(80%);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Tranquessa Admin</div>
        <div class="nav-links">
            <a href="{{ url('/') }}">Back to the Website</a>
            @if (session('admin_logged_in'))
                <a href="{{ route('admin.logout') }}" class="btn btn-outline-light">Logout</a>
            @endif
        </div>
    </div>

    <div class="container">
        <h1>Reservations List</h1>
        <a href="#" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addReservationModal">Add Reservation</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Room Type</th>
                    <th>Capacity</th>
                    <th>Payment</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $res)
                    <tr>
                        <td>{{ $res->id }}</td>
                        <td>{{ $res->name }}</td>
                        <td>{{ $res->contact_number }}</td>
                        <td>{{ $res->reservation_from }}</td>
                        <td>{{ $res->reservation_to }}</td>
                        <td>{{ $res->room_type }}</td>
                        <td>{{ $res->room_capacity }}</td>
                        <td>{{ $res->payment_type }}</td>
                        <td>{{ $res->created_at }}</td>
                        <td>
                            <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editReservationModal" 
                                    onclick="populateEditModal('{{ $res->id }}', '{{ $res->name }}', '{{ $res->contact_number }}', '{{ $res->reservation_from }}', '{{ $res->reservation_to }}', '{{ $res->room_type }}', '{{ $res->room_capacity }}', '{{ $res->payment_type }}')">Edit</button>
                            <button class="btn btn-delete" onclick="openDeleteModal('{{ $res->id }}')">Delete </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



    </div>

<!-- Add Reservation Modal -->
<div class="modal fade" id="addReservationModal" tabindex="-1" aria-labelledby="addReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addReservationForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReservationModalLabel">Add Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    <div id="add-form-errors" class="text-danger mb-2"></div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservation_from" class="form-label">Reservation From</label>
                        <input type="date" name="reservation_from" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservation_to" class="form-label">Reservation To</label>
                        <input type="date" name="reservation_to" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="room_type" class="form-label">Room Type</label>
                        <select name="room_type" class="form-select" required>
                            <option value="Suite">Suite</option>
                            <option value="De Luxe">De Luxe</option>
                            <option value="Regular">Regular</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="room_capacity" class="form-label">Room Capacity</label>
                        <select name="room_capacity" class="form-select" required>
                            <option value="Family">Family</option>
                            <option value="Double">Double</option>
                            <option value="Single">Single</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_type" class="form-label">Payment Type</label>
                        <select name="payment_type" class="form-select" required>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Credit Card">Credit Card</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Save Reservation</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editReservationForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editReservationLabel">Edit Reservation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id" id="edit_id">

          <div class="mb-3">
            <label for="edit_name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="edit_name" required>
          </div>

          <div class="mb-3">
            <label for="edit_contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" id="edit_contact_number" required>
          </div>

          <div class="mb-3">
            <label for="edit_reservation_from" class="form-label">Reservation From</label>
            <input type="date" class="form-control" name="reservation_from" id="edit_reservation_from" required>
          </div>

          <div class="mb-3">
            <label for="edit_reservation_to" class="form-label">Reservation To</label>
            <input type="date" class="form-control" name="reservation_to" id="edit_reservation_to" required>
          </div>

          <div class="mb-3">
            <label for="edit_room_type" class="form-label">Room Type</label>
            <select class="form-select" name="room_type" id="edit_room_type" required>
              <option value="Suite">Suite</option>
              <option value="De Luxe">De Luxe</option>
              <option value="Regular">Regular</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_room_capacity" class="form-label">Room Capacity</label>
            <select class="form-select" name="room_capacity" id="edit_room_capacity" required>
              <option value="Family">Family</option>
              <option value="Double">Double</option>
              <option value="Single">Single</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_payment_type" class="form-label">Payment Type</label>
            <select class="form-select" name="payment_type" id="edit_payment_type" required>
              <option value="Cash">Cash</option>
              <option value="Cheque">Cheque</option>
              <option value="Credit Card">Credit Card</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Reservation</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal for Deletion Confirmation -->
<div class="modal fade" id="deleteReservationModal" tabindex="-1" aria-labelledby="deleteReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteReservationModalLabel">Delete Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this reservation?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
 <script>

    </script>
</body>
</html>
<script>
document.getElementById('addReservationForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch("{{ route('admin.reservations.add') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message || 'Failed to add reservation.');
        }
    } catch (err) {
        console.error("AJAX error:", err);
        alert('Something went wrong.');
    }
});

</script>

<script>
document.getElementById('editReservationForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    const data = {
        id: document.getElementById('edit_id').value,
        name: document.getElementById('edit_name').value,
        contact_number: document.getElementById('edit_contact_number').value,
        reservation_from: document.getElementById('edit_reservation_from').value,
        reservation_to: document.getElementById('edit_reservation_to').value,
        room_type: document.getElementById('edit_room_type').value,
        room_capacity: document.getElementById('edit_room_capacity').value,
        payment_type: document.getElementById('edit_payment_type').value,
    };

    try {
        const response = await fetch("{{ route('admin.reservations.edit') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        const result = await response.json();
   if (result.success) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message || 'Failed to add reservation.');
        }
    } catch (err) {
        console.error("AJAX error:", err);
        alert('Something went wrong.');
    }
});
</script>

<script>
function populateEditModal(id, name, contact, from, to, roomType, roomCapacity, paymentType) {
    // Update the IDs to match the modal input fields
    document.getElementById('edit_id').value = id;  // Change from editReservationId to edit_id
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_contact_number').value = contact;
    document.getElementById('edit_reservation_from').value = from;
    document.getElementById('edit_reservation_to').value = to;
    document.getElementById('edit_room_type').value = roomType;
    document.getElementById('edit_room_capacity').value = roomCapacity;
    document.getElementById('edit_payment_type').value = paymentType;
}

// Store the reservation ID to be deleted
let deleteReservationId = null;

// Function to open the delete confirmation modal
function openDeleteModal(id) {
    deleteReservationId = id;  // Set the reservation ID to be deleted
    new bootstrap.Modal(document.getElementById('deleteReservationModal')).show();
}

// Function to handle the deletion when the user confirms
document.getElementById('confirmDeleteBtn').addEventListener('click', async function() {
    if (deleteReservationId) {
        try {
            // Construct the correct URL with the reservation ID
            const response = await fetch(`{{ url('admin/reservations/delete') }}/${deleteReservationId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                location.reload();  // Reload the page to reflect changes
            } else {
                alert(result.message || 'Failed to delete reservation.');
            }

            // Close the modal after the deletion action
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteReservationModal'));
            modal.hide();
        } catch (err) {
            console.error('AJAX error:', err);
            alert('Something went wrong during deletion.');
        }
    }
});



        
        </script>