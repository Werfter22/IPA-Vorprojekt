-- Tabelle für die Telefone
CREATE TABLE Phones (
    Phone_ID SERIAL PRIMARY KEY,
    Mobile_Number_1 VARCHAR(250),
    Mobile_Number_2 VARCHAR(250),
    Mobile_Number_3 VARCHAR(250),
    Mobile_Number_4 VARCHAR(250),
    Mobile_Number_5 VARCHAR(250),
    Mobile_Number_6 VARCHAR(250),
    Mobile_Number_7 VARCHAR(250),
    Mobile_Number_8 VARCHAR(250),
    Mobile_Number_9 VARCHAR(250),
    Mobile_Number_10 VARCHAR(250),
    Work_Number_1 VARCHAR(250),
    Work_Number_2 VARCHAR(250),
    Work_Number_3 VARCHAR(250),
    Work_Number_4 VARCHAR(250),
    Work_Number_5 VARCHAR(250),
    Work_Number_6 VARCHAR(250),
    Work_Number_7 VARCHAR(250),
    Work_Number_8 VARCHAR(250),
    Work_Number_9 VARCHAR(250),
    Work_Number_10 VARCHAR(250),
    QR_Code VARCHAR(250),
    Barcode VARCHAR(250)
);

-- Tabelle für die Geräte
CREATE TABLE Devices (
    Device_ID SERIAL PRIMARY KEY,
    Device_Name_1 VARCHAR(250),
    Device_Name_2 VARCHAR(250),
    Device_Name_3 VARCHAR(250),
    Device_Name_4 VARCHAR(250),
    Device_Name_5 VARCHAR(250),
    Device_Name_6 VARCHAR(250),
    Device_Name_7 VARCHAR(250),
    Device_Name_8 VARCHAR(250),
    Device_Name_9 VARCHAR(250),
    Device_Name_10 VARCHAR(250),
    Device_Name_11 VARCHAR(250),
    Device_Name_12 VARCHAR(250),
    Serialnumber_1 VARCHAR(250),
    Serialnumber_2 VARCHAR(250),
    Serialnumber_3 VARCHAR(250),
    Serialnumber_4 VARCHAR(250),
    Serialnumber_5 VARCHAR(250),
    Serialnumber_6 VARCHAR(250),
    Serialnumber_7 VARCHAR(250),
    Serialnumber_8 VARCHAR(250),
    Serialnumber_9 VARCHAR(250),
    Serialnumber_10 VARCHAR(250),
    Serialnumber_11 VARCHAR(250),
    Serialnumber_12 VARCHAR(250),
    OS_1 VARCHAR(250),
    OS_2 VARCHAR(250),
    OS_3 VARCHAR(250),
    OS_4 VARCHAR(250),
    OS_5 VARCHAR(250),
    OS_6 VARCHAR(250),
    OS_7 VARCHAR(250),
    OS_8 VARCHAR(250),
    OS_9 VARCHAR(250),
    OS_10 VARCHAR(250),
    OS_11 VARCHAR(250),
    OS_12 VARCHAR(250),
    QR_Code VARCHAR(250),
    Barcode VARCHAR(250),
    IS_Werft_Device_1 BOOLEAN,
    IS_Werft_Device_2 BOOLEAN,
    IS_Werft_Device_3 BOOLEAN,
    IS_Werft_Device_4 BOOLEAN,
    IS_Werft_Device_5 BOOLEAN,
    IS_Werft_Device_6 BOOLEAN,
    IS_Werft_Device_7 BOOLEAN,
    IS_Werft_Device_8 BOOLEAN,
    IS_Werft_Device_9 BOOLEAN,
    IS_Werft_Device_10 BOOLEAN,
    IS_Werft_Device_11 BOOLEAN,
    IS_Werft_Device_12 BOOLEAN,
    IS_Private_Device_1 BOOLEAN,
    IS_Private_Device_2 BOOLEAN,
    IS_Private_Device_3 BOOLEAN,
    IS_Private_Device_4 BOOLEAN,
    IS_Private_Device_5 BOOLEAN,
    IS_Private_Device_6 BOOLEAN,
    IS_Private_Device_7 BOOLEAN,
    IS_Private_Device_8 BOOLEAN,
    IS_Private_Device_9 BOOLEAN,
    IS_Private_Device_10 BOOLEAN,
    IS_Private_Device_11 BOOLEAN,
    IS_Private_Device_12 BOOLEAN
);

-- Tabelle für die Benutzer
CREATE TABLE Users (
    User_ID SERIAL PRIMARY KEY,
    Lastname VARCHAR(250),
    Firstname VARCHAR(250),
    Email_1 VARCHAR(250),
    Email_2 VARCHAR(250),
    Email_3 VARCHAR(250),
    QR_Code VARCHAR(250),
    Barcode VARCHAR(250)
);


-- Tabelle für die Inventar Liste Original
CREATE TABLE Inventar_Liste_Original (
    Inventar_Liste_Original_ID SERIAL PRIMARY KEY,
    Barcode VARCHAR(250),
    QR_Code VARCHAR(250),
    Name VARCHAR(250),
    Details TEXT,
    Transport_Unit VARCHAR(250),
    Location VARCHAR(250)
);

-- Tabelle für die Maschinen Liste
CREATE TABLE Machine_List (
    Machine_Liste_ID SERIAL PRIMARY KEY,
    IS_Obsolete BOOLEAN,
    Machine_Name VARCHAR(250), -- aktualisiert von 'Name' zu 'Machine_Name'
    Machine_Function VARCHAR(250), -- aktualisiert von 'Function' zu 'Machine_Function'
    Machine_Description TEXT, -- aktualisiert von 'Description' zu 'Machine_Description'
    IS_Virtual BOOLEAN,
    VM_Host VARCHAR(250),
    CPU VARCHAR(250),
    Cores VARCHAR(250),
    Ram_MB VARCHAR(250),
    OS VARCHAR(250),
    OS_INFO VARCHAR(250),
    Machine_Location VARCHAR(250), -- aktualisiert von 'Location' zu 'Machine_Location'
    Lowest_Unit FLOAT,
    Buy_Date TIMESTAMP,
    Value_Of_Hardware FLOAT,
    Restore_hours INTERVAL,
    Serialnumber VARCHAR(250),
    Production_Date TIMESTAMP,
    Disposal_Date TIMESTAMP
);


-- Zwischentabelle: User_Device
CREATE TABLE User_Device (
    user_id INT REFERENCES Users(User_ID) ON DELETE CASCADE,
    device_id INT REFERENCES Devices(Device_ID) ON DELETE CASCADE,
    zugeordnet_seit TIMESTAMP,
    nutzungsstatus VARCHAR(250),
    PRIMARY KEY (user_id, device_id)
);


-- Zwischentabelle: User_Phone
CREATE TABLE User_Phone (
    user_id INT REFERENCES Users(User_ID) ON DELETE CASCADE,
    phone_id INT REFERENCES Phones(Phone_ID) ON DELETE CASCADE,
    nutzungsstatus VARCHAR(250),
    besitzdauer INTERVAL,
    PRIMARY KEY (user_id, phone_id)
);


-- Zwischentabelle: Inventar_Device
CREATE TABLE Inventar_Device (
    inventar_id INT REFERENCES Inventar_Liste_Original(Inventar_Liste_Original_ID) ON DELETE CASCADE,
    device_id INT REFERENCES Devices(Device_ID) ON DELETE CASCADE,
    zugewiesen_am TIMESTAMP,
    zustand VARCHAR(250),
    PRIMARY KEY (inventar_id, device_id)
);


CREATE TABLE home_office (
    home_office_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id),
    device_id INT REFERENCES devices(device_id),
    status VARCHAR(20) DEFAULT 'Aktiv'
);

CREATE TABLE workplace (
    workplace_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id),
    device_id INT REFERENCES devices(device_id),
    status VARCHAR(20) DEFAULT 'Aktiv'
);










CREATE TABLE machine_inventar (
    machine_inventar_id SERIAL PRIMARY KEY,
    machine_liste_id INT NOT NULL,
     Inventar_Liste_Original_ID INT NOT NULL,
    FOREIGN KEY (machine_liste_id) REFERENCES machine_list(machine_liste_id),
    FOREIGN KEY (Inventar_Liste_Original_ID) REFERENCES inventar_liste_original(Inventar_Liste_Original_ID)
);



CREATE TABLE inventar_device (
    inventar_device_id SERIAL PRIMARY KEY,
    inventar_id INT NOT NULL,
    device_id INT NOT NULL,
    FOREIGN KEY (inventar_id) REFERENCES inventar_liste_original(inventar_id),
    FOREIGN KEY (device_id) REFERENCES devices(device_id)
);






