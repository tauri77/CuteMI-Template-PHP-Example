<?php

/**
 * This template assumes a single video stream, then merge resolution and video tech as general props.
 */
$generals  = [];
$v         = false;
if ( isset( $mediainfo['videos'] ) && isset( $mediainfo['videos'][0] ) ) {
	$v = $mediainfo['videos'][0];
}
/**
 * Set first video resolution and tech as general
 */
$generals['resolution'] = ! empty( $v ) && isset( $v['resolution'] ) && isset( $v['resolution']['text'] ) ? $v['resolution']['text'] : '';
$generals['format'] = ! empty( $mediainfo['format'] ) && isset( $mediainfo['format']['text'] ) ? $mediainfo['format']['text'] : '';
$generals['size'] = ! empty( $mediainfo['size'] ) && is_numeric( $mediainfo['size']['text'] ) ?
	cutemi_human_filesize( $mediainfo['size']['text'] ) : '';
$generals['duration'] = ! empty( $mediainfo['duration'] ) && is_numeric( $mediainfo['duration']['text'] ) ?
	cutemi_human_duration( $mediainfo['duration']['text'] ) : '';
$generals['tech'] = ! empty( $v ) && isset( $v['tech'] ) && isset( $v['tech']['text'] ) ? $v['tech']['text'] : '';

foreach ( $generals as $l => $general ) {
	if ( empty( $general ) ) {
		unset( $generals[ $l ] );
	}
}
/**
 * General props with video
 */
?>
<table class="vfi-template-php">
    <caption><?php echo $mediainfo['name'];?></caption>
    <tbody>
    <tr>
        <?php
            if ( ! empty( $generals ) ) {
                end( $generals );
                $last_general = key( $generals );
                foreach ( $generals as $l => $general ) {
                    echo '<td>' . esc_html( $general ) . '</td>';
                }
            }
        ?>
    </tr>
    </tbody>
</table>
<?php
/**
 * Audios
 */
if ( is_array( $mediainfo['audios'] ) && ! empty( $mediainfo['audios'] ) ) {
    ?>
    <table class="vfi-template-php">
        <caption>Audios</caption>
        <tbody>
        <?php
            foreach ( $mediainfo['audios'] as $k => $audio ) {
                if ( $audio['tech'] ) {
                    $row = [];
                    if ( ! empty( $audio['tech'] ) && ! empty( $audio['tech']['text'] ) ) {
                        $row[] = esc_html( $audio['tech']['text'] );
                    }
                    if ( ! empty( $audio['channels'] ) && ! empty( $audio['channels']['text'] ) ) {
                        $row[] = esc_html( $audio['channels']['text'] );
                    }
                    if ( ! empty( $audio['channels'] ) && ! empty( $audio['lang']['text'] ) ) {
                        $row[] = esc_html( $audio['lang']['text'] );
                    }
                    if ( ! empty( $row ) ) {
                        echo '<tr><td>'.implode( '</td><td>', $row ).'</td></tr>';
                    }
                }
            }
        ?>
        </tbody>
    </table>
    <?php
}
/**
 * Texts
 */
if ( is_array( $mediainfo['texts'] ) && ! empty( $mediainfo['texts'] ) ) {
    ?>
    <table class="vfi-template-php">
        <caption>Texts</caption>
        <tbody>
        <?php
            foreach ( $mediainfo['texts'] as $k => $text ) {
                if ( $text['format'] || $text['lang'] ) {
                    $row = [];
                    if ( ! empty( $text['format'] ) && ! empty( $text['format']['text'] ) ) {
                        $row[] = esc_html( $text['format']['text'] );
                    }
                    if ( ! empty( $text['lang'] ) && ! empty( $text['lang']['text'] ) ) {
                        $row[] = esc_html( $text['lang']['text'] );
                    }
                    if ( ! empty( $row ) ) {
                        echo '<tr><td>'.implode( '</td><td>', $row ).'</td></tr>';
                    }
                }
            }
        ?>
        </tbody>
    </table>
    <?php
}
/**
 * Links
 */
if ( is_array( $mediainfo['links'] ) && ! empty( $mediainfo['links'] ) ) {
    ?>
    <table class="vfi-template-php">
        <caption>Links</caption>
        <tbody>
        <?php
            foreach ( $mediainfo['links'] as $k => $link ) {
                if ( $link['source'] && $link['external_id'] ) {
                    $row = [];
                    $anchor = 'LINK';
                    if ( ! empty( $link['source'] ) && ! empty( $link['source']['text'] ) ) {
                        $anchor = esc_html( $link['source']['text'] );
                    }
                    if ( ! empty( $link['external_id'] ) && ! empty( $link['external_id']['text'] ) ) {
                        $row[] = '<a href="'.esc_url($link['external_id']['text']).'">'.esc_html( $anchor ).'</a>';
                    }
                    if ( ! empty( $row ) ) {
                        echo '<tr><td>'.implode( '</td><td>', $row ).'</td></tr>';
                    }
                }
            }
        ?>
        </tbody>
    </table>
    <?php
}
