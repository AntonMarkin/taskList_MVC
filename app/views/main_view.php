<div class="container py-4 pb-md-4 mx-auto text-center">

    <div class="mx-auto justify-content-center">
        <h2 class=" fw-normal">Список задач</h2>
        <hr>
        <form class="row mb-3 justify-content-center" method="post" action="/main/AddTask">
            <div class="col-sm-5">
                <input class="form-control" type="text" name="description" placeholder="Enter text..."></div>
            <div class="col-sm-1">
                <input class="btn btn-dark" name="add_task" type="submit" value="ADD TASK">
            </div>
        </form>
        <a href="/main/RemoveAllTasks" class="btn btn-danger col-sm-2">REMOVE ALL</a>
        <a href="/main/ReadyAllTasks" class="btn btn-success col-sm-2">READY ALL</a>

    </div>
    <hr>

    <div class="row row-cols-1 row-cols-md-1 mb-3 mx-auto justify-content-center">
        <?php
        if (isset($data))
            foreach ($data as $key => $item) {
                if ($key != 'user') {
                    echo ' <div class="col-auto ">
                <div class="card mx-auto mb-3 ' . $item['statusClass'] . ' border-3" style="max-width: 30rem;">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body ' . $item['text'] . '">

                                <p>' . $item['description'] . '</p>

                                <ul class="nav nav-pills">
                                    <li class="nav-item col">

                                        <form method="post" action="/main/ChangeTaskStatus">
                                            <input type="hidden" name="id" value="' . $item['taskId'] . '">
                                            <input type="hidden" name="status" value="' . $item['newStatus'] . '">
                                            <input class="col-auto btn ' . $item['button'] . '" name="change_task_status" type="submit"
                                                   value="' . $item['buttonStatus'] . '">
                                        </form>

                                    </li>
                                    <li class="nav-item col">

                                        <form method="post" action="/main/DeleteTask">
                                            <input type="hidden" name="id" value="' . $item['taskId'] . '">
                                            <input class="col-auto btn btn-outline-danger" name="delete_task" type="submit" value="DELETE">
                                        </form>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                }
            }
        ?>
    </div>
</div>
</div>
