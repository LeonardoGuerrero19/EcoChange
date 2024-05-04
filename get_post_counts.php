<?php
// get_post_counts.php

require "conection.php"; // Asegúrate de que este archivo contiene la conexión correcta

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Obtener los contadores de likes y dislikes para la publicación
    $sql = "SELECT likes_count, dislikes_count FROM post WHERE post_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $likes = $row['likes_count'];
        $dislikes = $row['dislikes_count'];

        echo json_encode(['likes' => $likes, 'dislikes' => $dislikes]);
    } else {
        echo json_encode(['error' => 'No se encontró la publicación.']);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($con);
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
        if (event.target.matches('.like-button') || event.target.matches('.dislike-button') || event.target.matches('.unvote-button')) {
            const post_id = event.target.dataset.postid;
            const action = event.target.matches('.like-button') ? 'like' : (event.target.matches('.dislike-button') ? 'dislike' : 'unvote');

            fetch('vote.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `post_id=${post_id}&action=${action}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message); // Mostrar mensaje de éxito
                    updatePostCounts(post_id);
                } else {
                    alert(data.message); // Mostrar mensaje de error o información
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    function updatePostCounts(post_id) {
        fetch(`get_post_counts.php?post_id=${post_id}`)
        .then(response => response.json())
        .then(data => {
            if (data.likes !== undefined && data.dislikes !== undefined) {
                document.querySelector(`#like-count-${post_id}`).innerText = data.likes;
                document.querySelector(`#dislike-count-${post_id}`).innerText = data.dislikes;
            }
        });
    }
});
</script>