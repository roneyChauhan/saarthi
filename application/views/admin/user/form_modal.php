<div class="form-body">
    <div class="row">
        <div class="col-md-3">
            <label for="name">Name</label> : 
        </div>
        <div class="col-md-9">
            <p><?php echo isset($inquiry->name) ? $inquiry->name : '' ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="name">Email</label> :
        </div>
        <div class="col-md-9">
            <p><?php echo isset($inquiry->email) ? $inquiry->email : '' ?></p>
        </div>
    </div>
    <?php if(isset($inquiry->type) && $inquiry->type == 1){ ?>    
        <div class="row">
            <div class="col-md-3">
                <label for="name">Subject</label> :
            </div>
            <div class="col-md-9">
                <p><?php echo isset($inquiry->subject) ? $inquiry->subject : '' ?></p>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-3">
            <label for="name">Message</label> :
        </div>
        <div class="col-md-9">
            <p><?php echo isset($inquiry->message) ? $inquiry->message : '' ?></p>
        </div>
    </div>
</div>
