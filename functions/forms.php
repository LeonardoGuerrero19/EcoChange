<?php
    function Modal_Create() {

    require "conection.php";
?>
    <dialog id="modal">
        <div class="form__container">
            <div class="form__label">
                <b>Crear una publicación</b>
                <button id="close__form"><i class="bi bi-x-circle-fill"></i></button>
            </div>
            <hr>
            <form id="FormCreate" action="create_post.php" method="post" enctype="multipart/form-data">
                <div class="form__user">
                    <div><?php echo $_SESSION["user_name"]; ?></div>
                    
                    <div class="form__menu">
                        <select name="topic-post">
                            <option selected disabled>Temas</option>
                        <?php
                            $sql = "SELECT topic_name FROM topics";
                            $result = $con->query($sql);

                            // mostrar los temas
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <option>'. $row["topic_name"] .'</option>
                                    ';
                                }
                            } 
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form__title">
                    <input type="text" name="title-post" placeholder="Escribe un título">
                </div>
                <div class="form__text">
                    <textarea placeholder="Comparte con la comunidad" name="text-post"></textarea>
                </div>

                <figure class="form__image">
                    <button type="button" id="remove-media"><i class="bi bi-x-circle-fill"></i></button>
                    <img id="chosen-image">
                    <video id="chosen-video" controls style="display: none;"></video>
                </figure>

                
                <div class="form__add">
                    <p>Agrega a tu publicación</p>
                    <div>
                        <label for="fileImage" class="custom-file-upload"><i class="bi bi-images"></i></label>
                        <input id="fileImage" type="file" name="image-post" accept="image/*">
                        <label for="fileVideo" class="custom-file-upload"><i class="bi bi-camera-reels"></i></label>
                        <input id="fileVideo" type="file" name="video-post" accept="video/*">
                    </div>
                </div>
                <button class="form__input" id="PubForm" name="create">Publicar</button>
            </form>
        </div>
    </dialog>
<?php
    }
?>