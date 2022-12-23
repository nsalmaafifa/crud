<?php
// 1. Buat koneksi dengan MySQL
$con = mysqli_connect("localhost","root","","todolist");

// 2. Cek Koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi Gagal:" . mysqli_connect_error();
    exit();
}else{
    // echo "Koneksi Berhasil";
}

// 3. Buat query select semua todo list
$query = "SELECT * FROM task";

// 4. baca data hasil query
$item = [];
if ($result = mysqli_query($con, $query)){
    while ($row = mysqli_fetch_assoc($result)){
      $item[] = $row;
    }

    // var_dump($items);

    mysqli_free_result($result);
}


// section insert item
// tangkap data item dari form method post
if (isset($_POST['item'])){
    $item = $_POST['item'];

    // buat query untuk memasukan item
    $query = "INSERT INTO task (item) values ('$item')";

    // 5. Jalankan query
    if (mysqli_query($con,$query)){
      echo "data baru berhasil disimpan";
      header("Refresh:0");
    }else{
      echo "Error ".mysqli_error($con);
    }
  }


    mysqli_close($con); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO DO LIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">

            <h4 class="text-center my-3 pb-3">To Do App</h4>

            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" form action="index.php" method="post">
              <div class="col-12">
                <div class="form-outline">
                <input type="text" id="form1" class="form-control" name="item" placeholder="Enter task here" />
                </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>

            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Todo item</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach($item as $key=>$value): ?>
            <tr>
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['item'] ;?></td>
            <td><?php echo ($value['status'] == 0) ? "in progress" : "finished"; ?> </td>
            <td>
                <a href="<?php echo 'delete.php?id='.$value["id"]; ?>" type="submit" class="btn btn-danger">Delete</a>
                <a href="<?php echo 'update.php?id='.$value["id"]; ?>" type="submit" class="btn btn-success ms-1">Finished</a>
            </td>
            </tr>
            
            <?php endforeach; ?>

              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>  