package com.sesehai.magic.database;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import com.sesehai.magic.provider.HouseProvider;
import com.sesehai.magic.provider.ItemProvider;
import com.sesehai.magic.provider.PositionProvider;
import com.sesehai.magic.provider.UserProvider;

/**
 * Created by luqi on 16/9/9.
 */

public class DatabaseHelper extends SQLiteOpenHelper {
    private static final String DATABASE_NAME = "magic.db";
    private static final int DATABASE_VERSION = 2;

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        // 创建user表
        Log.i("luq", "创建表开始");
        db.execSQL("CREATE TABLE  " + UserProvider.TABLE_NAME + " ("
                + UserProvider.COL_ID + " integer primary key autoincrement, "
                + UserProvider.COL_NAME + " text, "
                + UserProvider.COL_PASSWORD + " text, "
                + UserProvider.COL_NICKNAME + " text, "
                + UserProvider.COL_CTIME + " text, "
                + UserProvider.COL_UTIME + " text);");

        // 创建position表
        db.execSQL("CREATE TABLE  " + PositionProvider.TABLE_NAME + " ("
                + PositionProvider.COL_ID +" integer primary key autoincrement, "
                + PositionProvider.COL_HOUSE_ID + " integer, "
                + PositionProvider.COL_NAME + " text, "
                + PositionProvider.COL_DESC + " text, "
                + PositionProvider.COL_CTIME + " text, "
                + PositionProvider.COL_UTIME + " text);");

        // 创建item表
        db.execSQL("CREATE TABLE  " + ItemProvider.TABLE_NAME + " ("
                + ItemProvider.COL_ID + " integer primary key autoincrement, "
                + ItemProvider.COL_POSITION_ID + " integer, "
                + ItemProvider.COL_NAME + " text, "
                + ItemProvider.COL_DESC + " text, "
                + ItemProvider.COL_CTIME + " text, "
                + ItemProvider.COL_UTIME + " text);");

        // 创建house表
        db.execSQL("CREATE TABLE " + HouseProvider.TABLE_NAME + " ("
                + HouseProvider.COL_ID + " integer primary key autoincrement, "
                + HouseProvider.COL_USER_ID + " integer, "
                + HouseProvider.COL_NAME + " text, "
                + HouseProvider.COL_DESC + " text, "
                + HouseProvider.COL_CTIME + " text, "
                + HouseProvider.COL_UTIME + " text);");
        Log.i("luq", "创建表结束");
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + UserProvider.TABLE_NAME);
        db.execSQL("DROP TABLE IF EXISTS " + PositionProvider.TABLE_NAME);
        db.execSQL("DROP TABLE IF EXISTS " + ItemProvider.TABLE_NAME);
        db.execSQL("DROP TABLE IF EXISTS " + HouseProvider.TABLE_NAME);
        onCreate(db);
    }

}
