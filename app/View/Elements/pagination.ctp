<tfoot>
<tr>
    <td colspan="100" class="footable-visible">
        <div class="text-right">

            <ul class="pagination">
                <?php
                echo $this->Paginator->first(
                    '«'
                    , array('tag' => 'li')
                    , null
                    , array('class' => 'footable-page-arrow disabled')
                );

                $hasPrev = $this->Paginator->hasPrev();
                if ($hasPrev) {
                    echo $this->Paginator->prev(
                        '‹'
                        , array('tag' => 'li')
                        , null
                        , array('class' => 'footable-page-arrow disabled')
                    );
                }
                ?>

                <?php echo $this->Paginator->numbers(
                    array(
                        'tag' => 'li'
                    ,'currentTag' => 'a'
                    ,'currentClass' => 'footable-page active'
                    ,'separator' => ''
                    )
                );?>

                <?php
                $hasNext = $this->Paginator->hasNext();
                if ($hasNext) {
                    echo $this->Paginator->next(
                        '›'
                        , array('tag' => 'li')
                        , null
                        , array('class' => 'footable-page-arrow')
                    );
                }

                echo $this->Paginator->last(
                    '»'
                    , array('tag' => 'li')
                    , null
                    , array('class' => 'footable-page-arrow disabled')
                );
                ?>
            </ul>


        </div>
    </td>
</tr>
</tfoot>