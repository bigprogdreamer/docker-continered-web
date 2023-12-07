INSERT INTO Goods_type (goods_type_id, goods_name) VALUES
(1, 'flowers'),
(2, 'bouqet'),
(3, 'accessories');

-- Insert data into Goods
INSERT INTO Goods (goods_id, quantity, goods_type_id, price_per_item) VALUES
(1, 100, 1, 100.00),
(2, 150, 1, 150.00),
(3, 200, 3, 20.00);

-- Insert data into Flower
INSERT INTO Flower (goods_id, flower_type, color, aroma, height) VALUES
(1, 'Rose', 'Red', 'Sweet', '30 cm'),
(2, 'Lily', 'White', 'Fragrant', '40 cm'),
(3, 'Tulip', 'Yellow', 'Mild', '25 cm');

-- Insert data into employee
INSERT INTO employee (employee_id, gender, age, degree, work_time, salary) VALUES
(1, 'Male', 25, 'Bachelor', 40, 50000.00),
(2, 'Female', 30, 'Master', 35, 60000.00),
(3, 'Male', 28, 'PhD', 45, 40000.00);

DELIMITER //
CREATE TRIGGER cheque_action_insert
AFTER INSERT ON cheque
FOR EACH ROW
BEGIN
    DECLARE helper_new DECIMAL(10, 2);
    DECLARE user_idii INT;

    SET user_idii = NEW.client_id;
    SET helper_new = NEW.total_summ;

    UPDATE client
    SET total_spent = total_spent + helper_new
    WHERE user_id = user_idii;
END;
//
DELIMITER ;
