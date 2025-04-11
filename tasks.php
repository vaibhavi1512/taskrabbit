<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: index.php");
}
include_once "php/config.php";
include_once "header.php";

// Get user type
$sql = mysqli_query($conn, "SELECT user_type FROM users WHERE unique_id = {$_SESSION['unique_id']}");
$row = mysqli_fetch_assoc($sql);
$user_type = $row['user_type'];
?>

<div class="wrapper">
    <section class="tasks">
        <header>
            <div class="content">
                <h2>Available Tasks</h2>
                <div class="task-filters">
                    <select id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Carpenter">Carpentry</option>
                        <option value="Plumber">Plumbing</option>
                        <option value="Electrician">Electrical</option>
                        <option value="Painter">Painting</option>
                        <option value="Handyman">General Handyman</option>
                    </select>
                </div>
            </div>
        </header>
        <div class="tasks-list">
            <!-- Tasks will be loaded here -->
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const tasksList = document.querySelector('.tasks-list');
    
    // Function to load tasks
    function loadTasks(category = '') {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/get_tasks.php", true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    tasksList.innerHTML = xhr.response;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("category=" + category + "&status=posted");
    }
    
    // Load tasks on page load
    loadTasks();
    
    // Add event listener for category filter
    if(categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            loadTasks(this.value);
        });
    }
    
    // Handle task acceptance
    document.addEventListener('click', function(e) {
        if(e.target && e.target.classList.contains('accept-task')) {
            const taskId = e.target.getAttribute('data-task-id');
            const button = e.target;
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/accept_task.php", true);
            xhr.onload = () => {
                if(xhr.readyState === XMLHttpRequest.DONE) {
                    if(xhr.status === 200) {
                        if(xhr.response === "success") {
                            alert("Task accepted successfully!");
                            loadTasks(categoryFilter.value);
                        } else {
                            alert(xhr.response);
                        }
                    }
                }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("task_id=" + taskId);
        }
    });
});
</script>

<style>
.tasks {
    padding: 20px;
    max-width: 1200px;
    margin: 80px auto 50px;
}

.tasks header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--light-gray);
    margin-bottom: 30px;
}

.task-filters select {
    padding: 10px;
    border: 2px solid var(--light-gray);
    border-radius: 8px;
    font-size: 16px;
    background: var(--white);
    cursor: pointer;
}

.task-item {
    background: var(--white);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: var(--shadow);
}

.task-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.task-header img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 15px;
}

.task-user-info span {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-color);
}

.task-user-info p {
    color: #666;
    font-size: 14px;
}

.task-content h4 {
    color: var(--secondary-color);
    margin-bottom: 10px;
}

.task-content p {
    color: var(--text-color);
    margin-bottom: 15px;
    line-height: 1.6;
}

.task-details {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
}

.task-details span {
    color: var(--text-color);
}

.budget {
    color: var(--primary-color) !important;
    font-weight: 600;
}

.accept-task {
    background: var(--primary-color);
    color: var(--white);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    transition: var(--transition);
}

.accept-task:hover {
    background: var(--secondary-color);
    transform: translateY(-2px);
}
</style>
</body>
</html> 