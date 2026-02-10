<div class="settings-details-header d-md-flex align-items-center justify-content-between">
    <h4 class="d-flex align-items-center"> @php $isBackButton ? print('<a href="' . $backURL . '" class="back-btn"><i class="lni lni-arrow-left-circle"></i></a>') : '' @endphp {{$sectionTitle}}</h4>
    @php $isActionButton ? print('<a href="' . $actionButtonURL . '" class="btn ' . $btnClass . ' py-1">' . $actionButtonText . '</a>') : '' @endphp
</div>