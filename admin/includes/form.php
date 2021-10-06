<ul>
    <?php foreach ($book->errors as $error) : ?>
        <li class="form-errors"><?= $error; ?></li>
    <?php endforeach; ?>

</ul>
<form class="book-form" method="POST" enctype="multipart/form-data">

    <label for="title">Title <span class="required">*</span></label>
    <input name="title" value="<?= htmlspecialchars($book->title); ?>">

    <label for="author">Author <span class="required">*</span></label>
    <input name="author" value="<?= htmlspecialchars($book->author); ?>">

    <label for="year">Year published</label>
    <input type="number" name="year" min="-1000" max="2022" value="<?= ($book->year)  ?? ''; ?>">

    <label for="category">Category</label>
    <select name="category">
        <?php foreach ($book->categories as $idx => $category) : ?>
            <option value="<?= $category ?>"
             <?php if ($idx == $book->category) echo "selected"; ?>><?= ucfirst($category); ?></option>
        <?php endforeach; ?>
    </select>

    <label for="pages">Pages</label>
    <input name="pages" type="number" value="<?= htmlspecialchars($book->pages); ?>">

    <label for="publisher">Publisher</label>
    <input name="publisher" value="<?= htmlspecialchars($book->publisher); ?>">

    <div class="age-checkboxes">
        <label>Age group</label>
        <label><input type="radio" name="age" value="children" <?php if ($book->age_from == 0) echo "checked"; ?>>Kids</label>
        <label><input type="radio" name="age" value="adults" <?php if ($book->age_from == 1) echo "checked"; ?>>Adults</label>
    </div>

    <label for="image_file">Book cover</label>
    <p class="current-image-name"><?= $current_image_file; ?></p>
    <input type="file" name="image_file" id="image_file">

    <?php if ($upload_status == 'File uploaded') : ?>
        <p class="upload-status-success">File uploaded</p>
    <?php else : ?>
        <p class="upload-status"><?= $upload_status; ?></p>
    <?php endif; ?>
    <!-- processed path to image file is kept here. Not sure if it's safe though -->

    <input type="hidden" name="file_path" value="<?= $book->image_file; ?>">
    <button class="submit" name="submit">Submit</button>
    <button class="upload" name="upload">Upload image</button>
</form>