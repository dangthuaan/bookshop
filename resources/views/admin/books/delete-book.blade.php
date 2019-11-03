<!-- Bootstrap Modal: delete book-->
<div class="modal fade" id="deleteBookModal_{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBookModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteBookModalLabel">Delete book?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -21px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('books.destroy', ['book' => $book->id]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="alert alert-danger">
                        Are you sure to delete the book? You cannot go back! 
                    </div>
                        <input type="button" class="btn btn-success" data-dismiss="modal" value="{{ __('Close') }}">
                        <input type="submit" class="btn btn-alert" value="{{ __('Delete') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.Modal -->
