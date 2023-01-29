
<!-- Healthy Habits Modal -->
<!-- Inspiration for the meal planner taken from https://www.eatthismuch.com/ -->
<div class="modal fade" id="healthyHabitsModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="healthyHabitsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="healthyHabitsModalLabel">Healthy Habits - Meal Planner</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="./service.php">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="meal-type" id="meal-type" aria-label="Select meal type">
                            <!-- The db currently contains only data for vegan, vegetarian and Paleo options but new options can be added anytime -->
                            <option value="Anything" selected>Anything</option>
                            <option value="Paleo">Paleo</option>
                            <option value="Vegan">Vegan</option>
                            <option value="Vegetarian">Vegetarian</option>
                            <!-- <option value="Ketogenic">Ketogenic</option> -->
                        </select>
                        <label for="meal-type">Select meal type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="target-calories" id="target-calories" placeholder="name@example.com">
                        <label for="target-calories">Target Calories</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="number-of-meals" id="number-of-meals" aria-label="Select number of meals">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <label for="meal-type">Number of meals?</label>
                    </div>
                    <input type="hidden" name="service_id" value="4">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Plan!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>