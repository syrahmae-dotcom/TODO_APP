<style>
/* Modal background and body */
body {
    background: linear-gradient(135deg, #cae0f1ff, #5eb1e0ff);
    font-family: Arial, sans-serif;
}

/* Modal card style */
.modal-content {
    background: #dde5e9ff;
    border-radius: 15px;
    padding: 20px;
}

/* Modal header */
.modal-header {
    border-bottom: none;
    padding-bottom: 0;
}

.modal-title {
    font-weight: 700;
    letter-spacing: 1px;
    font-size: 1.25rem;
}

/* Close button hover */
.btn-close {
    cursor: pointer;
    transition: transform 0.2s ease;
}

.btn-close:hover {
    transform: scale(1.2);
}

/* Form labels and inputs */
.form-label, label {
    font-weight: 500;
}

.form-control, .form-select, textarea {
    border-radius: 10px;
    padding: 10px 12px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 8px rgba(94, 177, 224, 0.5);
    border-color: #5eb1e0ff;
}

/* Radio & checkbox */
.form-check-label {
    margin-left: 4px;
    font-weight: 500;
}

.form-check-input:checked {
    background-color: #5eb1e0ff;
    border-color: #5eb1e0ff;
}

/* Buttons */
button, .btn {
    border-radius: 10px;
    padding: 10px 15px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    background: linear-gradient(135deg, #f2f2f2, #f1c8c8ff, #f0afafff);
}

button:hover, .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}

/* Responsive spacing */
.mb-3 {
    margin-bottom: 1rem;
}
.row .col-md-6 {
    margin-bottom: 1rem;
}
</style>

<div class="modal-header">
 <h5 class="modal-title">Task</h5>
 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
 <div class="mb-3"><label>Title *</label><input type="text" name="title" class="form-control"
required></div>
 <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"
rows="3"></textarea></div>
 <div class="row">
 <div class="col-md-6 mb-3"><label>Status</label>
 <select name="status" class="form-select">
 <option value="pending">Pending</option>
 <option value="in_progress">In Progress</option>
 <option value="completed">Completed</option>
 </select>
 </div>
 <div class="col-md-6 mb-3"><label>Priority</label><br>
 <div class="form-check form-check-inline"><input type="radio" name="priority"
value="low" class="form-check-input"><label class="form-check-label">Low</label></div>
 <div class="form-check form-check-inline"><input type="radio" name="priority"
value="medium" class="form-check-input" checked><label class="form-check-label">Medium</label></div>
 <div class="form-check form-check-inline"><input type="radio" name="priority"
value="high" class="form-check-input"><label class="form-check-label">High</label></div>
 </div>
 </div>
 <div class="mb-3"><div class="form-check"><input type="checkbox" name="notifications"
class="form-check-input"><label class="form-check-label">Email when done</label></div></div>
 <div class="row">
 <div class="col-md-6 mb-3"><label>Due Date</label><input type="date" name="due_date"
class="form-control"></div>
 <div class="col-md-6 mb-3"><label>Category</label>
 <select name="category_id" class="form-select"><option value="">None</option>
 <?php
 $cats = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
 $cats->execute([$user_id]);
 foreach ($cats->fetchAll() as $c) {
 echo "<option value='{$c['id']}'>{$c['name']}</option>";
 }
 ?>
 </select>
 </div>
 </div>
 <div class="mb-3"><label>Attachment</label><input type="file" name="attachment" class="formcontrol" accept=".pdf,.jpg,.jpeg,.png"></div>
</div>