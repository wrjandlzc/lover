<div>
    <?php foreach ($news as $item) :?>
        <h1><?php echo $item['title'] ?></h1>
        <h2><?php echo $item['text']; ?></h2>
    <?php endforeach;?>
</div>