<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: index.php");
}
include_once "header.php";
?>

<div class="wrapper">
    <section class="form post-task">
        <header>Post a New Task</header>
        <form id="postTaskForm" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="error-text" style="display: none;"></div>
            
            <div class="field input">
                <label>Task Title</label>
                <input type="text" name="title" placeholder="Enter task title" required>
            </div>
            
            <div class="field input">
                <label>Task Description</label>
                <textarea name="description" placeholder="Describe your task in detail" required></textarea>
            </div>
            
            <div class="field input">
                <label>Category</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Carpenter">Carpentry</option>
                    <option value="Plumber">Plumbing</option>
                    <option value="Electrician">Electrical</option>
                    <option value="Painter">Painting</option>
                    <option value="Handyman">General Handyman</option>
                </select>
            </div>
            
            <div class="field input">
                <label>Budget ($)</label>
                <input type="number" name="budget" placeholder="Enter your budget" min="0" step="0.01" required>
            </div>
            
            <div class="field input">
                <label>Location</label>
                <input type="text" name="location" placeholder="Enter task location" required>
            </div>
            
            <div class="field button">
                <input type="submit" value="Post Task">
            </div>
        </form>
    </section>
</div>

<script src="javascript/post_task.js"></script>
</body>
</html> 