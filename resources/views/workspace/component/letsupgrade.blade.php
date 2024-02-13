<div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">You’ve reached your limit of 5 clients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Upgrade to Premium Workspace to manage additional clients and to access powerful features to grow
                    your business.</p>
                {{-- explain features that will get if premium --}}
                <p>Features:</p>
                <ul>
                    <li>Unlimited Clients</li>
                    <li>Download Feature</li>
                    <li>Custom Contract</li>
                    <li>Remove Watermark</li>
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
