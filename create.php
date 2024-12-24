<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi dan sanitasi input
    $name = trim($_POST['customer_name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone_number']);

    // Pastikan semua input terisi
    if (empty($name) || empty($address) || empty($phone)) {
        $error = "All fields are required.";
    } else {
        try {
            // Persiapkan query untuk memasukkan data
            $sql = "INSERT INTO deliveries (customer_name, address, phone_number) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $address, $phone);

            // Eksekusi dan periksa keberhasilannya
            if ($stmt->execute()) {
                header("Location: delivery.php");
                exit;
            } else {
                $error = "Failed to add delivery: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Delivery - Burger Bliss</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; /* Warna latar terang */
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #FF8C42; /* Warna utama oranye */
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input, textarea, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus, textarea:focus {
            border-color: #FF8C42;
            outline: none;
        }
        button {
            background-color: #FF8C42;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #FF6347;
        }
        .error {
            color: red;
            margin-bottom: 15px;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            form {
                padding: 15px;
            }
            input, textarea, button {
                font-size: 12px;
                padding: 10px;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <h1>Add New Delivery</h1>

    <form method="POST">
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <label for="customer_name">Name:</label>
        <input type="text" id="customer_name" name="customer_name" required placeholder="Enter customer name">

        <label for="address">Address:</label>
        <textarea id="address" name="address" required placeholder="Enter customer address"></textarea>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required placeholder="Enter phone number">

        <button type="submit">Add Delivery</button>
    </form>
</body>
</html>
