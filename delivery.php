<?php
include 'db_connection.php';

// Pastikan koneksi database berhasil
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan daftar pengiriman
$sql = "SELECT * FROM deliveries ORDER BY delivery_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery List - Burger Bliss</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #FF8C42; /* Warna oranye */
            padding: 20px;
            color: white;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 36px;
        }

        main {
            margin: 20px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        a {
            text-decoration: none;
            color: #FF8C42; /* Konsisten dengan tema */
            font-weight: bold;
        }

        a:hover {
            color: #FF6347; /* Warna hover lebih gelap */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #FF8C42; /* Warna oranye */
            color: white;
            font-size: 16px;
        }

        td {
            background-color: #fefefe;
            font-size: 14px;
        }

        td a {
            color: #FF8C42;
        }

        td a:hover {
            color: #FF6347;
        }

        .actions a {
            margin: 0 5px;
        }

        .add-delivery {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 20px;
            background-color: #FF8C42; /* Warna tombol */
            color: white;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .add-delivery:hover {
            background-color: #FF6347; /* Hover warna */
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 12px;
            }

            header {
                padding: 15px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Delivery List</h1>
</header>

<main>
    <a href="create.php" class="add-delivery">Add New Delivery</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Delivery Time</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivery_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td class="actions">
                            <a href="update.php?id=<?php echo urlencode($row['id']); ?>">Update</a> |
                            <a href="delete.php?id=<?php echo urlencode($row['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No deliveries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>
