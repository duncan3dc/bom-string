<?php

namespace duncan3dc\Bom;

use function stream_bucket_append;
use function stream_bucket_make_writeable;

class StreamFilter extends \php_user_filter
{

    public function onCreate(): void
    {
        $this->handler = new Handler;
    }


    public function onClose(): void
    {
        unset($this->handler);
    }


    public function filter($in, $out, &$consumed, $closing): int
    {
        while ($bucket = stream_bucket_make_writeable($in)) {
            $bucket->data = $this->handler->convert($bucket->data);
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return \PSFS_PASS_ON;
    }
}
