
<?php
// Hook para publicar notas nas redes sociais
function publicar_nota_mastodon($post_ID, $post) {
    if (get_post_type($post_ID) !== 'nota') {
        return;
    }

    $token = 'GxGgxh4C1Mq8m1RHDrNliIwbhEgVkJ0vxLwBR-uGQ6s'; // Token gerado no Mastodon
    $instance = 'https://www.mas.to/'; // Exemplo: mastodon.social

    $content = get_the_title($post_ID) . "\n\n" . get_permalink($post_ID);

    $args = [
        'body' => json_encode(['status' => $content]),
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ],
        'method' => 'POST'
    ];

    $response = wp_remote_post("$instance/api/v1/statuses", $args);
    
    if (is_wp_error($response)) {
        error_log("Erro ao publicar no Mastodon: " . $response->get_error_message());
    }
}
add_action('publish_nota', 'publicar_nota_mastodon', 10, 2);
?>