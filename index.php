<?php global $db;
include 'inc/header.php'; ?>

<?php
$name = $email = $courseName = $content = '';
$nameErr = $emailErr = $courseNameErr = $contentErr = '';

if (isset($_POST['submit'])) {
//验证姓名
    if (empty($_POST['name'])) {
        $nameErr = "Name is required";
    }else{
        $name =filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
}

//验证邮箱
if (empty($_POST['email'])) {
    $emailErr = "Email is required";
}else{
    $email =filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

//验证课程名称
if (empty($_POST['courseName'])) {
    $courseNameErr = "Course Name is required";
}else{
    $courseName = filter_input(INPUT_POST, 'COUrSe', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

//验证评论内容
if (empty($_POST['content'])) {
    $contentErr = "Content is required";
}else{
    $contentErr = filter_input(INPUT_POST, 'bOdy', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

if (empty($nameErr) && empty($emailErr) && empty($courseNameErr) && empty($contentErr)) {
    // 添加到数据库
    $sql = "INSERT INTO review (name, email, course_name, content) VALUES('$name', '$email', '$courseName', '$content')";

    if (mysqli_query($db, $sql)) {
        // 成功
        header('Location: reviews.php');
    } else {
        // 错误
        echo "出错：" . mysqli_error($db);
    }
}

echo $nameErr;
echo $name;

?>

        <img src="/course-review-app/1.png" class="w-25 mb-3" alt="">
        <h2>课程评价</h2>
        <p class="lead text-center">为你所上的课程留下评价</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75" >
            <div class="mb-3">
                <label for="name" class="form-label">你的姓名</label>
                <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>"
                       id="name" name="name" placeholder="请输入你的姓名">
                <div class="invalid-feedback">
                    <?php echo $nameErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">你的邮箱</label>
                <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null;?>" id="email" name="email" placeholder="请输入你的邮箱">
                <div class="invalid-feedback">
                    <?php echo $emailErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">课程名称</label>
                <input type="text" class="form-control <?php echo $courseNameErr ? 'is-invalid' : null;?>" id="course" name="course" placeholder="请输入课程名称">
                <div class="invalid-feedback">
                    <?php echo $courseNameErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">评价内容</label>
                <textarea class="form-control <?php echo $contentErr ? 'is-invalid' : null;?>" id="body" name="body" rows="4" placeholder="请输入你的评价"></textarea>
                <div class="invalid-feedback">
                    <?php echo $contentErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="submit" value="提交评价" class="btn btn-dark w-100">
            </div>
        </form>
<?php include 'inc/footer.php'; ?>
