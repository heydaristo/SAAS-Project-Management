<div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kamu telah mencapai batas maksimal 5 client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Upgrade ke Premium Workspace untuk mengelola klien tambahan dan mengakses fitur-fitur canggih untuk
                    mengembangkan bisnis Anda.</p>
                {{-- explain features that will get if premium --}}
                <p>Fitur:</p>
                <ul>
                    <li>No Pop Up Ads Premium</li>
                    <li>Unlimited Client</li>
                    <li>Editable Contract</li>

                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('workspace.subscriptions.upgradeshow') }}" class="text-white">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        Upgrade To Premium
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
