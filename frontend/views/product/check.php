<?php
/* @var $this yii\web\View */

?>
<div class="row">
    <div id="length">
<?= $data ?>
    </div>
    <div id="width">
    </div>
    <div id="height">
    </div>
    <div id="balance">
    </div>
</div>

<?php

$url_balance = \yii\helpers\Url::toRoute(['product/get-balance']);
$url_height = \yii\helpers\Url::toRoute(['product/get-height']);
$url_width = \yii\helpers\Url::toRoute(['product/get-width']);

$js = <<<EOL
    function initHeight(current){
        var current = current;
        $("#select-height > option").each(function () {
            $(this).on('click', function () {
                var value = $(this).attr('value');
                $.ajax({
                    url: "$url_balance&vendor=" + current +  value,
                    type: "get",
                    success: function (data) {
                        $('#balance').html(data);
                    }
                });
            });
        });
    };

    function initWidth(current){
        var current = current;
        $("#select-width > option").each(function () {
            $(this).on('click', function () {
                var value = $(this).attr('value');
                $.ajax({
                    url: "$url_height&width=" + value,
                    type: "get",
                    success: function (data) {
                        $('#height').empty();
                        $('#balance').empty();

                        $('#height').html(data);
                        initHeight(current +  value);
                    }
                });
            });
        });
    };

    $("#select-length > option").each(function () {
        $(this).on('click', function () {
            var value = $(this).attr('value');
            $.ajax({
                url: "$url_width&length=" + value,
                type: "get",
                success: function (data) {
                    $('#width').empty();
                    $('#height').empty();
                    $('#balance').empty();

                    $('#width').html(data);
                    initWidth(value);
                }
            });
        });
    });
EOL;
$this->registerJs($js);
?>