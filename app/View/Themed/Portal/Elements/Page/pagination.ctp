<div class="col-lg-12">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-plain">
            <?php
            //RGB: 235,114,55
            echo $this->Paginator->first
            (
                "«"
                , array('tag' => 'li')
                , null
                , array('class' => 'page-item disabled')
            );

            $hasPrev = $this->Paginator->hasPrev();

            if ($hasPrev)
            {
                echo $this->Paginator->prev(
                     $title = '‹'
                    ,array('tag' => 'li')
                    ,null
                    ,array('class' => 'page-item disabled')
                );
            }

            echo $this->Paginator->numbers
            (
                array
                (
                     'currentClass' => 'disabled'
                    ,'tag' => 'li'
                    ,'currentTag' => 'a'
                    ,'class' => 'page-item'
                    ,'separator' => null
                    ,'first' => 2
                    ,'last' => 2
                )
            );

            $hasNext = $this->Paginator->hasNext();
            if ( $hasNext )
            {
                echo $this->Paginator->next(
                     '›'
                    , array('tag' => 'li')
                    , null
                    , array('class' => 'page-item')
                );
            }

            echo $this->Paginator->last
            (
                '»'
                , array('tag' => 'li')
                , null
                , array('class' => 'page-item disabled')
            );
            ?>
        </ul>
        <script type="application/javascript">
            $( document ).ready(function()
            {
                $('ul.pagination-plain > li:first').addClass('page-item');
                $('ul.pagination-plain > li').eq(1).addClass('page-item');
                $("ul.pagination-plain > li:last").addClass("page-item")
                $("ul.pagination-plain > li:last").prev("li").addClass("page-item");
                $('ul.pagination-plain > li > a').addClass('page-link');
            });
        </script>
    </nav>
</div>