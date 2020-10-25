<?php

if ( isset($this->view) ) {
    extract($this->view->getData());
}

?>

<a href="/?controller=cars">View all cars</a>

<form method="POST" action="?controller=cars&action=create">

    <div>
        <label for="mark_id">Choose Marks:</label>
        <select id="mark_id" name="mark_id" />
            <option> - Marks - </option>
            <?php foreach( $marks as $mark) : ?>
                <option value="<?= $mark['mark_id']; ?>" <?php if ( isset($mark_id) && $mark_id == $mark['mark_id']) { echo 'select: selected'; } ?>><?php echo $mark['mark_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php 
            if ( isset($errors['mark_id']) ) {
                echo '<p class="error">' . $errors["mark_id"] . '</p>';
            }
        ?>
    </div>

    <div>
        <label for="model_id">Choose Marks:</label>
        <select id="model_id" name="model_id" />
            <option> - Models - </option>
            <?php foreach( $models as $model) : ?>
                <option value="<?= $model['model_id']; ?>" <?php if ( isset($model_id) && $model_id == $model['model_id']) { echo 'select: selected'; } ?>><?php echo $model['model_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php 
            if ( isset($errors['model_id']) ) {
                echo '<p class="error">' . $errors["model_id"] . '</p>';
            }
        ?>
    </div>

    <div>
        <label for="car_register_number">Enter Registe Number:</label>
        <input type="text" id="car_register_number" name="car_register_number" value="<?php echo isset($car_register_number) ? $car_register_number : '' ?>" placeholder="Register Number"/>
        <?php 
            if ( isset($errors['car_register_number']) ) {
                echo '<p class="error">' . $errors['car_register_number'] . '</p>';
            }
        ?>
    </div>

    <input type="submit" name="create_car" value="Add" />

</form>



<script>

    $('#mark_id').on('change', function() {

        //console.log($( this ).val());

        $.ajax({
            //url: '/?controller=cars&action=getModelsByMark',
            url: '/src/Solver/Ajax.php/?function=getModelsByMark',
            type: 'post',
            dataType: 'json',
            data: { 'mark_id': $( this ).val() },
            success: function( data ) {
                // console.log(data);
                if (data.status) {
                    $('#model_id').html( '<option> - Models - </option>' );
                    $.each(data.results, function(index, result) {
                        $('#model_id').append("<option value="+result['model_id']+">"+result['model_name']+"</option>");
                        console.log(result);
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

</script>