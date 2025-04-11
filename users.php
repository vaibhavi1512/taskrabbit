<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: index.php");
  }

  // Get current user's type
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  $row = mysqli_fetch_assoc($sql);
  $user_type = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'user';
?>

<?php include_once "header.php"; ?>

<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </div>
            <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
        </header>

        <?php if($user_type == 'user') { ?>
            <div class="profession-filter">
                <button class="filter-btn" data-profession="">All</button>
                <button class="filter-btn" data-profession="Carpenter">Carpenter</button>
                <button class="filter-btn" data-profession="Plumber">Plumber</button>
                <button class="filter-btn" data-profession="Electrician">Electrician</button>
                <button class="filter-btn" data-profession="Painter">Painter</button>
                <button class="filter-btn" data-profession="Handyman">Handyman</button>
            </div>
        <?php } ?>

        <div class="users-list">
            <!-- Users list will be loaded here -->
        </div>
    </section>
</div>

<?php include_once "footer.php"; ?>

<script src="javascript/users.js"></script>
<script>
    const professionSelect = document.getElementById('professionSelect');
    
    <?php if($user_type == 'user') { ?>
    // User view - Filter taskers by profession
    if(professionSelect) {
        professionSelect.addEventListener('change', function() {
            const profession = this.value;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `php/get_users.php${profession ? '?profession=' + profession : ''}`, true);
            xhr.onload = function(){
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                        document.querySelector('.users-list').innerHTML = xhr.response;
                    }
                }
            }
            xhr.send();
        });
    }
    <?php } ?>

    // Load initial data
    window.onload = function() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "php/get_users.php", true);
        xhr.onload = function(){
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    document.querySelector('.users-list').innerHTML = xhr.response;
                }
            }
        }
        xhr.send();
    }
</script>
