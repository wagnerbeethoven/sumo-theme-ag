<?php

function publicar_nota_bluesky($post_ID, $post)
{
  if (get_post_type($post_ID) !== 'nota') {
    return;
  }

  $handle = 'wagnerbeethoven.bsky.social';
  $app_password = '2hbt-rnib-agre-v4iz';

  $api_url = 'https://bsky.social/xrpc/com.atproto.repo.createRecord';

  $post_data = [
    'repo' => $handle,
    'collection' => 'app.bsky.feed.post',
    'record' => [
      'text' => get_the_title($post_ID) . "\n\n" . get_permalink($post_ID),
      'createdAt' => gmdate('Y-m-d\TH:i:s\Z')
    ]
  ];

  $args = [
    'body' => json_encode($post_data),
    'headers' => [
      'Content-Type' => 'application/json',
      'Authorization' => 'Basic ' . base64_encode("$handle:$app_password")
    ],
    'method' => 'POST'
  ];

  $response = wp_remote_post($api_url, $args);

  if (is_wp_error($response)) {
    error_log("Erro ao publicar no Bluesky: " . $response->get_error_message());
  }
}
add_action('publish_nota', 'publicar_nota_bluesky', 10, 2);

?>