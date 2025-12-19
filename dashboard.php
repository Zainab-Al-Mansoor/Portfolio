<!-- username   :   admin -->
<!-- password   :   Zainab@2007 -->

<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

include('connection.php');

// --- 1. HANDLE UPDATE ACTION (Same Page Submission) ---
if (isset($_POST['update_message'])) {
    // 1. Sanitize and validate inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    $message_content = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($id && $name && $email && $message_content) {
        // 2. Prepare the SQL Update statement (SECURE)
        $sql_update = "UPDATE contact_messages SET name = ?, email = ?, subject = ?, message = ? WHERE id = ?";
        
        if ($stmt_update = $conn->prepare($sql_update)) {
            $stmt_update->bind_param("ssssi", $name, $email, $subject, $message_content, $id);

            if ($stmt_update->execute()) {
                $_SESSION['message'] = "Message ID {$id} updated successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error updating message: " . $stmt_update->error;
                $_SESSION['message_type'] = "error";
            }
            $stmt_update->close();
        } else {
             $_SESSION['message'] = "Database prepare failed: " . $conn->error;
             $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Error: Missing or invalid update fields.";
        $_SESSION['message_type'] = "error";
    }

    // Redirect to clear the POST data and display the message (Post/Redirect/Get pattern)
    // This keeps you on dashboard.php and prevents form resubmission on refresh.
    header("Location: dashboard.php");
    exit;
}

// --- 2. HANDLE DELETE ACTION ---
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    // Using a Prepared Statement for secure deletion
    $sql_delete = "DELETE FROM contact_messages WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $delete_id);

    if ($stmt_delete->execute()) {
        $_SESSION['message'] = "Message ID {$delete_id} deleted successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error deleting message: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    // Redirect to clear the POST data
    header("Location: dashboard.php");
    exit;
}
// -------------------------------------------

// Fetch all contact messages for display
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching messages: " . $conn->error);
}

// Check for and display session messages
$message = $_SESSION['message'] ?? null;
$message_type = $_SESSION['message_type'] ?? null;
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Zainab</title>


  <link rel="icon" type="image/png" href="img/fav.png">


  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 min-h-screen">

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold text-blue-700 mb-4 sm:mb-0">
            <span role="img" aria-label="dashboard-icon">📊</span> Admin Dashboard
        </h1>
        <a href="logout.php" class="bg-red-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300 shadow-md">
            Logout
        </a>
    </div>
<?php if ($message): ?>
    <div class="p-4 mb-6 rounded-xl font-bold text-sm shadow-xl flex items-center space-x-3 
        <?php 
        if ($message_type == 'success') {
            echo 'bg-white text-green-700 border-l-4 border-green-500 ring-1 ring-green-200';
            $icon = '✅';
        } else {
            echo 'bg-white text-red-700 border-l-4 border-red-500 ring-1 ring-red-200';
            $icon = '❌';
        }
        ?>">
        
        <span class="text-xl"><?php echo $icon; ?></span>
        
        <p><?php echo $message; ?></p>
        
    </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800">Contact Messages</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-600">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider max-w-xs truncate">Subject</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if($result->num_rows > 0): ?>
                        <?php $row_index = 0; while($row = $result->fetch_assoc()): ?>
                        <tr class="<?php echo $row_index % 2 == 0 ? 'bg-white' : 'bg-gray-50'; ?> hover:bg-blue-50 transition duration-150">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['id']); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-blue-600 hover:text-blue-800 transition"><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></td>
                            <td class="px-4 py-4 text-sm text-gray-600 max-w-xs overflow-hidden truncate" title="<?php echo htmlspecialchars($row['message']); ?>"><?php echo htmlspecialchars($row['subject']); ?> - <?php echo htmlspecialchars(substr($row['message'], 0, 50)) . '...'; ?></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo date("M d, Y", strtotime($row['created_at'])); ?></td>
                            
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex space-x-2 justify-center">
                                    <button onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars(addslashes($row['name'])); ?>', '<?php echo htmlspecialchars(addslashes($row['email'])); ?>', '<?php echo htmlspecialchars(addslashes($row['subject'])); ?>', '<?php echo htmlspecialchars(addslashes($row['message'])); ?>')" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition duration-150">
                                        Update
                                    </button>

                                    <button onclick="openDeleteModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars(addslashes($row['name'])); ?>')" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition duration-150">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php $row_index++; endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-10 text-xl text-gray-500 bg-white">
                                <span role="img" aria-label="no-messages-icon">👋</span> No messages found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Delete Message</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="deleteModalText">
                    Are you sure you want to delete the message from **[Name]**? This action cannot be undone.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form method="POST" action="dashboard.php" class="inline-block">
                    <input type="hidden" name="delete_id" id="modalDeleteId">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 w-full sm:w-auto">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="closeDeleteModal()" class="mt-3 px-4 py-2 bg-gray-200 text-gray-700 text-base font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-150 w-full sm:w-auto sm:ml-3">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-8 border w-11/12 md:w-1/2 shadow-2xl rounded-xl bg-white">
        <h3 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-6">Edit Contact Message</h3>
        <form action="dashboard.php" method="POST" id="editForm" class="space-y-4">
            <input type="hidden" name="id" id="editId">
            <input type="hidden" name="update_message" value="1"> <div>
                <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="editName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="editEmail" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="editSubject" class="block text-sm font-medium text-gray-700">Subject</label>
                <input type="text" name="subject" id="editSubject" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="editMessage" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="editMessage" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>
            
            <div class="flex justify-end pt-4 space-x-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-150">Cancel</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-150">Save Changes</button>
            </div>
        </form>
    </div>
</div>


<script>
    // --- DELETE MODAL JAVASCRIPT ---
    const deleteModal = document.getElementById('deleteModal');
    const modalDeleteId = document.getElementById('modalDeleteId');
    const deleteModalText = document.getElementById('deleteModalText');

    function openDeleteModal(id, name) {
        modalDeleteId.value = id;
        deleteModalText.innerHTML = `Are you sure you want to delete the message from **${name}**? This action cannot be undone.`;
        deleteModal.style.display = 'block';
    }

    function closeDeleteModal() {
        deleteModal.style.display = 'none';
    }

    // --- EDIT MODAL JAVASCRIPT ---
    const editModal = document.getElementById('editModal');
    
    function openEditModal(id, name, email, subject, message) {
        // Populate the form fields
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editSubject').value = subject;
        document.getElementById('editMessage').value = message;
        
        // Show the modal
        editModal.style.display = 'block';
    }

    function closeEditModal() {
        editModal.style.display = 'none';
    }

    // Close modals when clicking outside the modal content
    window.onclick = function(event) {
        if (event.target == deleteModal) {
            closeDeleteModal();
        }
        if (event.target == editModal) {
            closeEditModal();
        }
    }
</script>

</body>
</html>